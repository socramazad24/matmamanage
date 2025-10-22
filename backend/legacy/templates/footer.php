<?php 
namespace templates;

    class Footer {
        public static function Footer($pageTitle){
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title><?php echo $pageTitle; ?></title>
                <script src='../tailwind.js' integrity='sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF' crossorigin='anonymous'></script>
                
            </head>
            <body>

            <footer>
            <div class='flex flex-wrap -mx-3 mb-5'>
                    <div class='w-full max-w-full sm:w-3/4 mx-auto text-center'>
                        <p class='text-sm text-slate-500 py-1'>&copy; 2023 MAT-MANAGER  by <a
                                class='text-slate-700 hover:text-slate-900' target='_blank'>Sergio De La Hoz & Marcos Daza</a>.</p>
                    </div>
                </div>
            </footer>

                <main>
            
            
            ";
        }
    }


?>
