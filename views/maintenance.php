<?php
defined('ABSPATH') || exit;

/**
 * Template file for Maintenance Mode in JSD_Framework Settings under Debug Tab
 * Feel free to edit this file, incoming data are from class.maintenance.php
 */

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo esc_html($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="author" content="<?php echo esc_attr($author); ?>" />
    <meta name="description" content="<?php echo esc_attr($description); ?>" />
    <meta name="keywords" content="<?php echo esc_attr($keywords); ?>" />
    <meta name="robots" content="<?php echo esc_attr($robots); ?>" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500,700&amp;subset=latin-ext" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'IBM Plex Sans', sans-serif;
            background-color: white;
            height: 100%;
            width: 100%;
        }
        .container {
            display: flex;
            align-items: center;
            align-content: center;
            height: 100vh;
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: .25rem;
            border: none;
        }

    </style>

</head>

<body>
    <div class="container">
        <div class="row mx-auto justify-content-center">
            <div class="col-md-8 card">
                <h1 class="mb-4 mt-5">Error 503</h1>
                <p class="info mt-2 mb-5">
                    <?php echo __('Momentálne na stránke prebieha údržba. Ospravedlňujeme sa za vzniknuté problémy. O chvíľu sme späť!', PLUGIN_TEXT_DOMAIN) ?>
                </p>

                <div class="mt-5 mb-2 d-flex justify-content-between">
                    <svg id="Group_2" data-name="Group 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 220.016 46.693" width="150px">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #000;
                                }
                            </style>
                        </defs>
                        <path id="Path_1" data-name="Path 1" class="cls-1" d="M112.138,56.365a30.233,30.233,0,0,0-4.856-1.266,19,19,0,0,1-3.175-.851c-.664-.27-1-.643-1-1.162q0-1.058,1.37-1.058a2.756,2.756,0,0,1,3.009,2.137h9.193a10.739,10.739,0,0,0-3.839-6.5,12.557,12.557,0,0,0-8.135-2.47,14.354,14.354,0,0,0-5.728,1.017,7.892,7.892,0,0,0-3.549,2.8,6.988,6.988,0,0,0-1.2,4.047,6.475,6.475,0,0,0,1.411,4.4,8,8,0,0,0,3.3,2.262,38.711,38.711,0,0,0,4.773,1.245,18.539,18.539,0,0,1,3.279.809,1.331,1.331,0,0,1,1.017,1.245c0,.706-.5,1.058-1.515,1.058-1.868,0-2.885-.726-3.071-2.179H94a9.936,9.936,0,0,0,3.943,6.661c2.137,1.536,5,2.3,8.612,2.3A15.084,15.084,0,0,0,112.2,69.9a8.094,8.094,0,0,0,3.632-2.7,6.6,6.6,0,0,0,1.245-3.943,6.518,6.518,0,0,0-1.473-4.483A8.27,8.27,0,0,0,112.138,56.365Z" transform="translate(-74.493 -35.82)" />
                        <path id="Path_2" data-name="Path 2" class="cls-1" d="M224.2,20.327a6.749,6.749,0,0,0-2.677-2.719,8.354,8.354,0,0,0-4.192-1,9.449,9.449,0,0,0-5.271,1.536,10.274,10.274,0,0,0-3.715,4.441A15.942,15.942,0,0,0,207,29.437a16.19,16.19,0,0,0,1.349,6.848,10.253,10.253,0,0,0,3.715,4.441,9.5,9.5,0,0,0,5.271,1.536,8.354,8.354,0,0,0,4.192-1,6.8,6.8,0,0,0,2.677-2.739v3.424h9.857V9.1H224.2Zm-.975,12.2a3.374,3.374,0,0,1-2.615,1.1,3.446,3.446,0,0,1-2.615-1.1,4.431,4.431,0,0,1-1.017-3.113A4.431,4.431,0,0,1,218,26.3a3.374,3.374,0,0,1,2.615-1.1,3.446,3.446,0,0,1,2.615,1.1,4.431,4.431,0,0,1,1.017,3.113A4.431,4.431,0,0,1,223.228,32.529Z" transform="translate(-164.043 -7.212)" />
                        <rect id="Rectangle_8" data-name="Rectangle 8" class="cls-1" width="9.857" height="25.027" transform="translate(72.011 9.691)" />
                        <path id="Path_3" data-name="Path 3" class="cls-1" d="M424.873,54.42V46.7H404.225v8.176h9.422L404.1,64.007v7.72h21.209V63.572H414.87Z" transform="translate(-320.24 -37.009)" />
                        <path id="Path_4" data-name="Path 4" class="cls-1" d="M536.061,70.618V45.591h-9.816v3.424a6.672,6.672,0,0,0-2.7-2.719,8.489,8.489,0,0,0-4.213-1,9.449,9.449,0,0,0-5.271,1.536,10.274,10.274,0,0,0-3.715,4.441A15.943,15.943,0,0,0,509,58.125a16.191,16.191,0,0,0,1.349,6.848,10.253,10.253,0,0,0,3.715,4.441,9.5,9.5,0,0,0,5.271,1.536,8.489,8.489,0,0,0,4.213-1,6.6,6.6,0,0,0,2.7-2.739v3.424h9.816Zm-10.833-9.4a3.374,3.374,0,0,1-2.615,1.1,3.446,3.446,0,0,1-2.615-1.1,5.273,5.273,0,0,1,0-6.226,3.374,3.374,0,0,1,2.615-1.1,3.446,3.446,0,0,1,2.615,1.1,4.431,4.431,0,0,1,1.017,3.113A4.337,4.337,0,0,1,525.228,61.217Z" transform="translate(-403.371 -35.899)" />
                        <path id="Path_5" data-name="Path 5" class="cls-1" d="M726.936,45.8a9.148,9.148,0,0,0-4.586,1.1,8.987,8.987,0,0,0-3.092,2.885v-3.8H709.4V71.014h9.857V57.753a4.1,4.1,0,0,1,.934-2.822,3.3,3.3,0,0,1,2.573-1.038,3.345,3.345,0,0,1,2.553,1.038,4.011,4.011,0,0,1,.955,2.822V71.014h9.816V56.508a11.7,11.7,0,0,0-2.428-7.8A8.252,8.252,0,0,0,726.936,45.8Z" transform="translate(-562.183 -36.295)" />
                        <path id="Path_6" data-name="Path 6" class="cls-1" d="M862.924,46.736a14.057,14.057,0,0,0-6.641-1.536,13.882,13.882,0,0,0-6.641,1.556,11.147,11.147,0,0,0-4.524,4.462,13.759,13.759,0,0,0-1.619,6.807,13.759,13.759,0,0,0,1.619,6.807,11.147,11.147,0,0,0,4.524,4.462,13.824,13.824,0,0,0,6.641,1.556,13.346,13.346,0,0,0,5.707-1.224,12.022,12.022,0,0,0,4.3-3.32,10.785,10.785,0,0,0,2.241-4.773H858.089a2.409,2.409,0,0,1-2.3,1.473,2.59,2.59,0,0,1-1.868-.685,3.994,3.994,0,0,1-.851-2.553h15.751a9.4,9.4,0,0,0,.228-1.951,13.3,13.3,0,0,0-1.619-6.7A10.66,10.66,0,0,0,862.924,46.736Zm-9.733,8.986a2.872,2.872,0,0,1,3.113-2.8,2.9,2.9,0,0,1,1.992.685,2.611,2.611,0,0,1,.789,2.117Z" transform="translate(-668.454 -35.82)" />
                        <path id="Path_7" data-name="Path 7" class="cls-1" d="M986.651,47.128a12.049,12.049,0,0,0-3.694,3.486V45.987H973.1V71.014h9.857V60.762a4.082,4.082,0,0,1,1.307-3.466,6.965,6.965,0,0,1,4.109-.975h2.8V45.8A8.664,8.664,0,0,0,986.651,47.128Z" transform="translate(-771.159 -36.295)" />
                        <path id="Path_8" data-name="Path 8" class="cls-1" d="M7.927,71.046h0v4.192H4.213V79.43H0v4.192H7.471q10.3,0,10.293-10.252V46.6H7.927Z" transform="translate(0 -36.929)" />
                        <rect id="Rectangle_9" data-name="Rectangle 9" class="cls-1" width="6.952" height="6.952" transform="translate(9.38)" />
                        <path id="Path_9" data-name="Path 9" class="cls-1" d="M636.415,71.046h0v4.192H632.7v8.384h3.279q10.3,0,10.293-10.252V46.6h-9.857Z" transform="translate(-501.4 -36.929)" />
                        <rect id="Rectangle_10" data-name="Rectangle 10" class="cls-1" width="6.952" height="6.952" transform="translate(136.467)" />
                        <rect id="Rectangle_11" data-name="Rectangle 11" class="cls-1" width="6.952" height="6.952" transform="translate(73.463)" />
                    </svg>
                    <small style="color: #bbbbbb">#JSD_Version <?php echo JSD_Config::$info['version'] ?></small>
                </div>

            </div>
        </div>
    </div>
</body>

</html>