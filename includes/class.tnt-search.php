<?php
defined('ABSPATH') || exit;

use TeamTNT\TNTSearch\TNTSearch;

/**
 * @docs https://github.com/teamtnt/tntsearch
 */

class JSD_TNT
{
    private $config = [
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'storage'   => ABSPATH . '/tntsearch/',
            'stemmer'   => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class //optional
    ];

    private $query = 
    'SELECT 
post_id,
t.name AS product_category,
IF(p.post_parent = 0, p.ID, p.post_parent) AS post_parent,
(SELECT post_title FROM wp_posts WHERE id = pm.post_id) AS title,
(SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_price" LIMIT 1) AS price, 
(SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_regular_price" LIMIT 1) AS "regular price", 
(SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_stock" LIMIT 1) AS stock, 
(SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_stock_status" LIMIT 1) AS "stock status", 
IFNULL((SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_sku" LIMIT 1),
    (SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_custom_field" LIMIT 1)) as SKU,
IFNULL(SUBSTR( (SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_product_attributes" LIMIT 1),
    INSTR((SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_product_attributes" LIMIT 1), "is_variation")+16,1),1) AS "variation"

FROM `wp_postmeta` AS pm
JOIN wp_posts AS p ON p.ID = pm.post_id
JOIN wp_term_relationships AS tr ON tr.object_id = IF(p.post_parent = 0, p.ID, p.post_parent)
JOIN wp_term_taxonomy AS tt ON tt.taxonomy = "product_cat" AND tt.term_taxonomy_id = tr.term_taxonomy_id 
JOIN wp_terms AS t ON t.term_id = tt.term_id

WHERE meta_key in ("_product_version")
AND p.post_status in ("publish")
AND IFNULL(SUBSTR((SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_product_attributes" LIMIT 1),
INSTR((SELECT meta_value FROM wp_postmeta WHERE post_id = pm.post_id AND meta_key = "_product_attributes" LIMIT 1), "is_variation")+16,1),0)=0';

    public function __construct()
    {
        // Initiate TNT Search
        $tnt = new TNTSearch;
        $tnt->loadConfig($this->config);

        // Index all Products
        $this->indexer($tnt);

    }

    public function indexer($tnt)
    {
        $indexer = $tnt->createIndex('products.index');
        $indexer->setPrimaryKey('post_id');
        $indexer->query($this->query);
        $indexer->run();
    }

    public function search()
    {
        $tnt = new TNTSearch;

        $tnt->loadConfig($this->config);
        $tnt->selectIndex("products.index");

        $res = $tnt->search($_POST["string"], 12);

        return $res;

    }


}

// new JSD_TNT;
?>