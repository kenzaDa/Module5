<?php
namespace App\Tests\Service;
use PHPUnit\Framework\TestCase;
use App\Service\FileSystemImproved;

Class FileSystemImprovedTest extends TestCase
{ public function teststate()
    {
                $FSI = new FileSystemImproved();
       $this->assertSame(['file117.txt','file13.txt','file17.txt'], $FSI->state());
    }
}