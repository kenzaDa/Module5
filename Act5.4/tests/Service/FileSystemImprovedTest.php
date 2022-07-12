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
      $this->assertSame(['file6.txt','file7.txt','file8.txt'], $FSI->createFile('file8'));
     }
      public function testdeleteFile()
      {
             $FSI = new FileSystemImproved();
      $this->assertSame(true, $FSI->deleteFile('file7'));
      }

      public function testdeleteFileInexistant()
      {
             $FSI = new FileSystemImproved();
      $this->assertTrue($FSI->deleteFile('file1'));
      }


}

