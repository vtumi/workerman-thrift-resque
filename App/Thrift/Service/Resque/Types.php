<?php
/**
 * Autogenerated by Thrift Compiler (0.9.3)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 * @generated
 */
namespace App\Thrift\Service\Resque;

use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


class Request {
    static $_TSPEC;

    /**
     * @var string
     */
    public $queue = null;
    /**
     * @var string
     */
    public $job = null;
    /**
     * @var array
     */
    public $params = null;
    /**
     * @var bool
     */
    public $trackStatus = false;
    /**
     * @var string
     */
    public $id = null;
    /**
     * @var string[]
     */
    public $jobs = null;

    public function __construct($vals=null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                1 => array(
                    'var' => 'queue',
                    'type' => TType::STRING,
                ),
                2 => array(
                    'var' => 'job',
                    'type' => TType::STRING,
                ),
                3 => array(
                    'var' => 'params',
                    'type' => TType::MAP,
                    'ktype' => TType::STRING,
                    'vtype' => TType::STRING,
                    'key' => array(
                        'type' => TType::STRING,
                    ),
                    'val' => array(
                        'type' => TType::STRING,
                    ),
                ),
                4 => array(
                    'var' => 'trackStatus',
                    'type' => TType::BOOL,
                ),
                5 => array(
                    'var' => 'id',
                    'type' => TType::STRING,
                ),
                6 => array(
                    'var' => 'jobs',
                    'type' => TType::LST,
                    'etype' => TType::STRING,
                    'elem' => array(
                        'type' => TType::STRING,
                    ),
                ),
            );
        }
        if (is_array($vals)) {
            if (isset($vals['queue'])) {
                $this->queue = $vals['queue'];
            }
            if (isset($vals['job'])) {
                $this->job = $vals['job'];
            }
            if (isset($vals['params'])) {
                $this->params = $vals['params'];
            }
            if (isset($vals['trackStatus'])) {
                $this->trackStatus = $vals['trackStatus'];
            }
            if (isset($vals['id'])) {
                $this->id = $vals['id'];
            }
            if (isset($vals['jobs'])) {
                $this->jobs = $vals['jobs'];
            }
        }
    }

    public function getName() {
        return 'Request';
    }

    public function read($input)
    {
        $xfer = 0;
        $fname = null;
        $ftype = 0;
        $fid = 0;
        $xfer += $input->readStructBegin($fname);
        while (true)
        {
            $xfer += $input->readFieldBegin($fname, $ftype, $fid);
            if ($ftype == TType::STOP) {
                break;
            }
            switch ($fid)
            {
                case 1:
                    if ($ftype == TType::STRING) {
                        $xfer += $input->readString($this->queue);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 2:
                    if ($ftype == TType::STRING) {
                        $xfer += $input->readString($this->job);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 3:
                    if ($ftype == TType::MAP) {
                        $this->params = array();
                        $_size0 = 0;
                        $_ktype1 = 0;
                        $_vtype2 = 0;
                        $xfer += $input->readMapBegin($_ktype1, $_vtype2, $_size0);
                        for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
                        {
                            $key5 = '';
                            $val6 = '';
                            $xfer += $input->readString($key5);
                            $xfer += $input->readString($val6);
                            $this->params[$key5] = $val6;
                        }
                        $xfer += $input->readMapEnd();
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 4:
                    if ($ftype == TType::BOOL) {
                        $xfer += $input->readBool($this->trackStatus);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 5:
                    if ($ftype == TType::STRING) {
                        $xfer += $input->readString($this->id);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 6:
                    if ($ftype == TType::LST) {
                        $this->jobs = array();
                        $_size7 = 0;
                        $_etype10 = 0;
                        $xfer += $input->readListBegin($_etype10, $_size7);
                        for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
                        {
                            $elem12 = null;
                            $xfer += $input->readString($elem12);
                            $this->jobs []= $elem12;
                        }
                        $xfer += $input->readListEnd();
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                default:
                    $xfer += $input->skip($ftype);
                    break;
            }
            $xfer += $input->readFieldEnd();
        }
        $xfer += $input->readStructEnd();
        return $xfer;
    }

    public function write($output) {
        $xfer = 0;
        $xfer += $output->writeStructBegin('Request');
        if ($this->queue !== null) {
            $xfer += $output->writeFieldBegin('queue', TType::STRING, 1);
            $xfer += $output->writeString($this->queue);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->job !== null) {
            $xfer += $output->writeFieldBegin('job', TType::STRING, 2);
            $xfer += $output->writeString($this->job);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->params !== null) {
            if (!is_array($this->params)) {
                throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
            }
            $xfer += $output->writeFieldBegin('params', TType::MAP, 3);
            {
                $output->writeMapBegin(TType::STRING, TType::STRING, count($this->params));
                {
                    foreach ($this->params as $kiter13 => $viter14)
                    {
                        $xfer += $output->writeString($kiter13);
                        $xfer += $output->writeString($viter14);
                    }
                }
                $output->writeMapEnd();
            }
            $xfer += $output->writeFieldEnd();
        }
        if ($this->trackStatus !== null) {
            $xfer += $output->writeFieldBegin('trackStatus', TType::BOOL, 4);
            $xfer += $output->writeBool($this->trackStatus);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->id !== null) {
            $xfer += $output->writeFieldBegin('id', TType::STRING, 5);
            $xfer += $output->writeString($this->id);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->jobs !== null) {
            if (!is_array($this->jobs)) {
                throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
            }
            $xfer += $output->writeFieldBegin('jobs', TType::LST, 6);
            {
                $output->writeListBegin(TType::STRING, count($this->jobs));
                {
                    foreach ($this->jobs as $iter15)
                    {
                        $xfer += $output->writeString($iter15);
                    }
                }
                $output->writeListEnd();
            }
            $xfer += $output->writeFieldEnd();
        }
        $xfer += $output->writeFieldStop();
        $xfer += $output->writeStructEnd();
        return $xfer;
    }

}

class InvalidValueException extends TException {
    static $_TSPEC;

    /**
     * @var int
     */
    public $error_code = null;
    /**
     * @var string
     */
    public $error_msg = null;

    public function __construct($vals=null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                1 => array(
                    'var' => 'error_code',
                    'type' => TType::I32,
                ),
                2 => array(
                    'var' => 'error_msg',
                    'type' => TType::STRING,
                ),
            );
        }
        if (is_array($vals)) {
            if (isset($vals['error_code'])) {
                $this->error_code = $vals['error_code'];
            }
            if (isset($vals['error_msg'])) {
                $this->error_msg = $vals['error_msg'];
            }
        }
    }

    public function getName() {
        return 'InvalidValueException';
    }

    public function read($input)
    {
        $xfer = 0;
        $fname = null;
        $ftype = 0;
        $fid = 0;
        $xfer += $input->readStructBegin($fname);
        while (true)
        {
            $xfer += $input->readFieldBegin($fname, $ftype, $fid);
            if ($ftype == TType::STOP) {
                break;
            }
            switch ($fid)
            {
                case 1:
                    if ($ftype == TType::I32) {
                        $xfer += $input->readI32($this->error_code);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 2:
                    if ($ftype == TType::STRING) {
                        $xfer += $input->readString($this->error_msg);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                default:
                    $xfer += $input->skip($ftype);
                    break;
            }
            $xfer += $input->readFieldEnd();
        }
        $xfer += $input->readStructEnd();
        return $xfer;
    }

    public function write($output) {
        $xfer = 0;
        $xfer += $output->writeStructBegin('InvalidValueException');
        if ($this->error_code !== null) {
            $xfer += $output->writeFieldBegin('error_code', TType::I32, 1);
            $xfer += $output->writeI32($this->error_code);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->error_msg !== null) {
            $xfer += $output->writeFieldBegin('error_msg', TType::STRING, 2);
            $xfer += $output->writeString($this->error_msg);
            $xfer += $output->writeFieldEnd();
        }
        $xfer += $output->writeFieldStop();
        $xfer += $output->writeStructEnd();
        return $xfer;
    }

}
