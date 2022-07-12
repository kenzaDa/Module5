<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\IOException;
use App\Service\FileSystemImproved;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\EventListener\ExceptionListener;







class FilesController extends AbstractController
{
    /**
     * @Route("/test", name="app_files")
     */
    public function index(): Response
    {
        return $this->render('files/index.html.twig', [
            'controller_name' => 'FilesController',
        ]);
    }



    /**
     * @Route("/find", name="finde")
     */
    public function find( Filesystem $filesystem ): Response
    { 
        $bundles = array();  
$finder = new Finder();
$finder->directories()->in('../..')->name('web');
 
foreach ($finder as $f) {
    $contents = $f->getRealPath();
 
}
return new Response($contents);
}


/**
     * @Route("/create/{filename}", name="create_files")
     */

public function Create(string $filename):Response
 {
// init file system

try {
    $fsObject = new Filesystem();
    // $current_dir_path = getcwd();
 
    // $new_file_path = $current_dir_path . "/$filename.txt";
 
    if (!$fsObject->exists(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\".$filename.".txt"))
    {
        $fsObject->touch(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\".$filename.".txt");
        $fsObject->chmod(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\".$filename.".txt", 0777);
        //  $fsObject->dumpFile($new_file_path, "Adding dummy content to bar.txt file.\n");
        //  $fsObject->appendToFile($new_file_path, "This should be added to the end of the file.\n");
         $message ="new file created";
    }

} catch (IOExceptionInterface $exception) {
    echo "Error creating file at". $exception->getPath();
}

 return new Response($message);
}

 /**
      * @Route("/write/{filename}/{text}", name="write_files" )
      */

    public function Write(string $filename, string $text):Response     {
   // init file system
   
   $fsObject = new Filesystem();
//    $current_dir_path = getcwd();
//    $new_file_path = $current_dir_path . "/$filename.txt";
    { if (!$fsObject->exists(dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\".$filename.".txt")){
        !$fsObject->dumpFile($filename, $text);
       
    }else{
        $fsObject->appendToFile($filename, $text);
    }
    return new Response($filename . ' is added with the text: ' . $text);
    }
    }

/**
      * @Route("/copy/{filename}/{filename_copy}", name="copy_files" )
      */

      public function Copyfile(string $filename, string $filename_copy):Response {

    try {
        $fsObject = new Filesystem();
        $current_dir_path = dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\" ;
        $src_dir_path = $current_dir_path .$filename.".txt";
        $dest_dir_path = $current_dir_path . $filename_copy.".txt";
     
        if (!$fsObject->exists($dest_dir_path))
        {
            $fsObject->copy($src_dir_path, $dest_dir_path , true);
        }

    } catch (IOExceptionInterface $exception) {
        echo "Error copying directory at". $exception->getPath();
    }
    return new Response($filename . ' is COPIED');
}



/**
      * @Route("/delete/{filename}", name="delete_files" )
      */
      public function Delete(string $filename):Response {

        try {
            $fsObject = new Filesystem();
            $current_dir_path =dirname(getcwd()) . "\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\";
            $src_dir_path = $current_dir_path . "/$filename";
       
         
            if ($fsObject->exists($src_dir_path))
            {
                $fsObject->remove(['symlink', $src_dir_path, "/$filename" ]);
            }
    
        } catch (IOExceptionInterface $exception) {
            echo "Error deleting directory at". $exception->getPath();
        }
        return new Response($filename . ' is deleted');
    }
/**
      * @Route("/state", name="state" )
      */
    public function State(FileSystemImproved $fileSystemImproved){
        $returnValue = $fileSystemImproved->state();
        
        return new JsonResponse(($returnValue));
    }

/**
      * @Route("/create-file/{filename}", name="create-file" )
      */
    public function Create_File(FileSystemImproved $FSI,$filename){
        $returnValue=$FSI->createFile($filename);
        return new JsonResponse(($returnValue));
    }
/**
      * @Route("/delete-file/{filename}", name="deletef" )
      */
      public function delete_File(FileSystemImproved $FSI,$filename){
        $returnValue=$FSI->deleteFile($filename);
        return new JsonResponse(json_encode($returnValue));
        
        
        
        
        
    }
    /**
      * @Route("/write-in-file/{filename}/{text}/{offset}", name="writein" )
      */
      public function writeIn(FileSystemImproved $FSI,$filename, $text, $offset){
        $returnValue=$FSI->WriteInFile($filename , $text, $offset = 0);
        return new JsonResponse(json_encode($returnValue));
    }

   /**
      * @Route("/read-file/{filename}", name="read" )
      */
      public function read(FileSystemImproved $FSI,$filename){
        $returnValue = $FSI->readFile($filename);
        return new JsonResponse(json_encode($returnValue));
    }
    
}