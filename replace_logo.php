<?php
$dir = new RecursiveDirectoryIterator('c:\investdu-app\resources\views');
$ite = new RecursiveIteratorIterator($dir);
foreach($ite as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
        $content = file_get_contents($file);
        $newContent = str_replace('<a href="/" class="logo">', '<a href="{{ (Auth::check() && Auth::user()->is_admin) ? \'/admin\' : \'/\' }}" class="logo">', $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Updated $file\n";
        }
    }
}
?>
