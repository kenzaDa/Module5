<?php 
namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\IOException;






class FileSystemImproved {

    private $fs;
    private $finder;

    public function __construct()
    {
        $this->fs = new Filesystem();
        $this->finder  = new Finder();
//creer fsi par le constructeur si fsi n'existe pas
        if (!$this->fs->exists(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\fsi")) {
            $this->fs->mkdir(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\fsi");
        }
    }


    // Retoune un tableau associatif
    public function state(){
        $this->finder->in(dirname(getcwd()))->path('fsi');
        foreach ($this->finder as $file) {
            $path = $file->getPath().'\\';
        }
        $tab = $this->finder->files()->in($path);
        foreach ($tab as $file) {
            $files[] = $file->getFilename();
        }
        return $files;
    }
   // Créé un fichier et retourne un tableau représentant tous les fichiers présents dans le meme dossier que lui après sa création
    public function createFile($filename){

        try {
           
            $current_dir_path = dirname(getcwd()) ."\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\fsi";
         
            $new_file_path = $current_dir_path . "/$filename.txt";
         
            if (!$this->fs->exists($new_file_path))
            {
                $this->fs->touch($new_file_path);
                $this->fs->chmod($new_file_path, 0777);
               
                 $message="new file created";
            }
        
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at". $exception->getPath();
        }
        $message="new file created";
         return new Response($message);
    }



// Supprime un fichier. Retoune True en cas de succès et false en cas d'échec. Si le fichier n'existait pas, c'est un echec.
public function deleteFile($filename)
{
    $files = $this->finder->in(dirname(getcwd()))->path($filename.'.txt');
    if (!$files->hasResults()) {
        return false;
    }

    foreach ($files as $file) {
        $path = $file->getRealPath();
    }

    $this->fs->remove($path);
    return true;
}
// Écrit dans un fichier à partir du $offset ième caractère.
public function writeInFile($filename, $text, $offset = 0)
{
    $files = $this->finder->in(dirname(getcwd()))->path($filename.'.txt');
    if (!$files->hasResults()) {
        return false;
    }
    foreach ($files as $file) {
        $path = $file->getRealPath();
    }
    $file = fopen($path,'a+');
    fseek($file,$offset);
    fwrite($file,$text);
    fclose($file);
    return true;
}
// Retourne le contenu d'un fichier
public function readFile($filename){
    $files = $this->finder->in(dirname(getcwd()))->path($filename.'.txt');
    if (!$files->hasResults()) {
        return false;
    }
    foreach ($files as $file) {
        $path = $file->getRealPath();
    }
    $file = fopen($path,'r+');
    $resultat = fread($file,filesize($path));
    return $resultat;
}
} 



