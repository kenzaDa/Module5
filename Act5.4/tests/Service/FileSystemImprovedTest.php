<?php
namespace App\Tests\Service;
use PHPUnit\Framework\TestCase;
use App\Service\FileSystemImproved;

Class FileSystemImprovedTest extends TestCase{
 public function teststate()
    {
                $FSI = new FileSystemImproved();
      $this->assertSame(['file8.txt'], $FSI->state());
   }
      public function testcreateFile()
      {
             $FSI = new FileSystemImproved();
      $this->assertSame(['file8.txt','file9.txt'], $FSI->createFile('file9'));
     }
      public function testdeleteFile()
      {
             $FSI = new FileSystemImproved();
      $this->assertSame(true, $FSI->deleteFile('file9'));
      }

      public function testdeleteFileInexistant()
      {
             $FSI = new FileSystemImproved();
      $this->assertSame(false,$FSI->deleteFile('file1'));
      }
      public function testWriteInFile()
      {
             $FSI = new FileSystemImproved();
      $this->assertTrue($FSI->writeInFile('file8','hello'));
      }
      public function testWriteInFileInexistant(){
        $fsi = new FileSystemImproved();
        $this->assertSame(false,$fsi->writeInFile('file1','hello'));
    }
 
    public function testReadFile(){
        $fsi = new FileSystemImproved();
        $this->assertNotFalse($fsi->readFile('file8'));
    }
 
    public function testReadFileInexistant(){
        $fsi = new FileSystemImproved();
        $this->assertFalse($fsi->readFile('file1'));
    }


}

