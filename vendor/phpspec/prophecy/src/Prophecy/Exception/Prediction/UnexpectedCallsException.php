<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Exception\Prediction;

use Prophecy\Call\Call;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Exception\Prophecy\MethodProphecyException;

class UnexpectedCallsException extends MethodProphecyException implements PredictionException
{
    /** @var list<Call> */
    private $calls;

    /**
     * @param string         $message
     * @param MethodProphecy $methodProphecy
     * @param array<Call>     $calls
     */
    public function __construct($message, MethodProphecy $methodProphecy, array $calls)
    {
        parent::__construct($message, $methodProphecy);

        $this->calls = array_values($calls);
    }

    /**
     * @return list<Call>
     */
    public function getCalls()
    {
        return $this->calls;
    }
}
