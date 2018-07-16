<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Sniffs\AbstractSniffs;

use PHP_CodeSniffer\Files\File;

abstract class AbstractMethodAnnotationSniff extends AbstractSprykerSniff
{
    /**
     * @var bool
     */
    protected $fileExists = false;

    /**
     * @inheritdoc
     */
    public function register()
    {
        return [
            T_CLASS,
        ];
    }

    /**
     * @param \PHP_CodeSniffer\Files\File $phpCsFile
     * @param int $stackPointer
     *
     * @return bool
     */
    protected function hasDocBlock(File $phpCsFile, int $stackPointer): bool
    {
        $tokens = $phpCsFile->getTokens();

        return ($tokens[$stackPointer - 2]['type'] === 'T_DOC_COMMENT_CLOSE_TAG');
    }

    /**
     * @param \PHP_CodeSniffer\Files\File $phpCsFile
     * @param string $className
     *
     * @return bool
     */
    protected function fileExists(File $phpCsFile, string $className): bool
    {
        $fileName = $phpCsFile->getFilename();
        $fileNameParts = explode(DIRECTORY_SEPARATOR, $fileName);
        $sourceDirectoryPosition = array_search('src', $fileNameParts);
        $basePathParts = array_slice($fileNameParts, 0, $sourceDirectoryPosition + 1);

        $basePath = implode(DIRECTORY_SEPARATOR, $basePathParts) . DIRECTORY_SEPARATOR;
        $classFileName = str_replace('\\', DIRECTORY_SEPARATOR, $className);

        $fileName = $basePath . $classFileName . '.php';

        return file_exists($fileName);
    }
}
