<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * != should be used instead of <>.
 */
class NotEqualSniff implements Sniff
{
    /**
     * @var array
     */
    public static $matching = [
        '<>' => '!=',
    ];

    /**
     * @inheritdoc
     */
    public function register()
    {
        return [T_IS_NOT_EQUAL];
    }

    /**
     * @inheritdoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $content = $tokens[$stackPtr]['content'];
        $key = strtolower($content);

        if (!isset(static::$matching[$key])) {
            return;
        }

        $fix = $phpcsFile->addFixableError($content . ' found, expected ' . static::$matching[$key], $stackPtr, 'NotEqualInvalid');
        if ($fix) {
            $phpcsFile->fixer->replaceToken($stackPtr, static::$matching[$key]);
        }
    }
}