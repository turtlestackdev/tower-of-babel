<?php


namespace TowerOfBabelTest\Utilities;


use PHPUnit\Framework\TestCase;
use TowerOfBabel\Utilities\Path;

class PathTest extends TestCase {

    public function test_join(): void {
        $tests = [
            [
                'paths' => ['/', 'var', '/lib'],
                'expected' => '/var/lib',
            ],
            [
                'paths' => ['/', 'etc', 'systemd', 'system.conf'],
                'expected' => '/etc/systemd/system.conf',
            ],
            [
                'paths' => ['/mnt/media/', '/TV Shows/Mystery Science Theater 3000/',
                    '/Season 08/Mystery Science Theater 3000 - S08E16 - Prince of Space.mkv'],
                'expected' => '/mnt/media/TV Shows/Mystery Science Theater 3000/Season 08/Mystery Science Theater 3000 - S08E16 - Prince of Space.mkv',
            ],
            [
                'paths' => ['/mnt/media/', '/TV Shows/Mystery Science Theater 3000/', '/Season 09/',
                    'Mystery Science Theater 3000 - S09E03 - The Pumaman.mkv'],
                'expected' => '/mnt/media/TV Shows/Mystery Science Theater 3000/Season 09/Mystery Science Theater 3000 - S09E03 - The Pumaman.mkv',
            ],
            [
                'paths' => ['/mnt/Projects/DEV/', '/Sample/ABC-1234/A/', '/dealy/test/', 'a_file.txt'],
                'expected' => '/mnt/Projects/DEV/Sample/ABC-1234/A/dealy/test/a_file.txt',
            ],
            [
                'paths' => ['/mnt/Projects/DEV//Sample/ABC-1234/A/', '/dealy/test/a_file.txt'],
                'expected' => '/mnt/Projects/DEV/Sample/ABC-1234/A/dealy/test/a_file.txt',
            ],
            [
                'paths' => ['/mnt/Projects/DEV/Sample/ABC-1234/A/', '/dealy/test/'],
                'expected' => '/mnt/Projects/DEV/Sample/ABC-1234/A/dealy/test',
            ],
            [
                'paths' => ['/mnt/Projects/DEV/Sample/ABC-1234/A/', '/dealy/test'],
                'expected' => '/mnt/Projects/DEV/Sample/ABC-1234/A/dealy/test',
            ],
            [
                'paths' => ['/mnt/Projects/DEV/Sample/ABC-1234/A/', '/dealy/test'],
                'expected' => '/mnt/Projects/DEV/Sample/ABC-1234/A/dealy/test',
            ],
            [
                'paths' => [],
                'expected' => '',
            ],
            [
                'paths' => [''],
                'expected' => '',
            ],
            [
                'paths' => ['', '', ''],
                'expected' => '',
            ],
            [
                'paths' => ['http://www.test.com/path/', '/dealy/test'],
                'expected' => 'http://www.test.com/path/dealy/test',
            ],
            [
                'paths' => ['https://www.test.com/path/', '/dealy/test'],
                'expected' => 'https://www.test.com/path/dealy/test',
            ],
            [
                'paths' => ['www.test.com/path/', '/dealy/test/'],
                'expected' => 'www.test.com/path/dealy/test',
            ],
        ];

        foreach ($tests as $test) {
            $this->assertEquals($test['expected'], Path::join(...$test["paths"]));
        }
    }
}