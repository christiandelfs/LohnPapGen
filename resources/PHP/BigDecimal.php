<?php
/**
* Klasse BigDecimal
*
* @author     Christian Delfs
*/
namespace Services;

class BigDecimal
{
	public static $ZERO = 0;
	public static $ONE = 1;
	public static $TEN = 10;
    public static $MAX_SCALE = 2147483647;
    public static $ROUND_UP          = 1;
    public static $ROUND_DOWN        = 2;
    public static $ROUND_CEILING     = 3;
    public static $ROUND_FLOOR       = 4;
    public static $ROUND_HALF_UP     = 5;
    public static $ROUND_HALF_DOWN   = 6;
    public static $ROUND_HALF_EVEN   = 7;
    public static $ROUND_HALF_ODD    = 8;
    public static $ROUND_UNNECESSARY = 9;
    public static $STRING_FORMAT_REGEX  = '/^([-+])?([0-9]+)(\.([0-9]+))?(E([+-]?[0-9]+))?$/';
    private $value;
    private $scale;
    
    public static function ZERO() {
    	return new BigDecimal(0);
    }
    
    public static function ONE() {
    	return new BigDecimal(1);
    }
    
    public static function TEN() {
    	return new BigDecimal(10);
    }
    
    public function __construct($value, $scale = null)
    {
        if ($scale !== null) {
            $scale = (int) $scale;
            if (abs($scale) > self::$MAX_SCALE) {
                throw new \InvalidArgumentException(sprintf('Scale "%s" is grater than max "%s"', $scale, self::$MAX_SCALE));
            }
        }
        //if (!is_scalar($value)) {
            //throw new \InvalidArgumentException(sprintf('Value of type "%s" is not as scalar', gettype($value)));
        //}
        $value = (string) $value;
        if (!preg_match(self::$STRING_FORMAT_REGEX, $value, $matches)) {
            throw new \InvalidArgumentException(sprintf('Wrong value "%s" format: expected "%s"', $value, self::$STRING_FORMAT_REGEX));
        }
        $sign = $matches[1] === '-' ? '-' : '';
        $integer = ltrim($matches[2], '0') ?: '0';
        $fraction = isset($matches[4]) ? $matches[4] : '';
        $exponent = - strlen($fraction) + (isset($matches[6]) ? (int)$matches[6] : 0);
        $significand = $sign . $integer . $fraction;
        $exponentScale = abs(min($exponent, 0));
        $newValue = bcmul($significand, bcpow(10, $exponent, $exponentScale), $exponentScale);
        list($integer, $fraction) = (array_pad(explode('.', $newValue, 2), 2, ''));
        if ($scale === null) {
            $scale = strlen($fraction);
        } else {
            $scale = (int) $scale;
            if (strlen($fraction) > $scale) {
                $fraction = substr($fraction, 0, $scale);
            } else {
                $fraction = str_pad($fraction, $scale, '0');
            }
        }
        $this->value = $integer . ($scale ? ('.' . $fraction) : '');
        $this->scale = $scale;
        //self::$ZERO = new BigDecimal(0);
        //self::$ONE = new BigDecimal(1);
        //self::$TEN = new BigDecimal(10);
        
    }
    /**
     * @param $value
     * @param null $scale
     * @return static
     */
    public static function create($value, $scale = null)
    {
        return new static($value, $scale);
    }
    /**
     * zero
     *
     * @return static
     */
    /*public static function zero()
    {
        return new static(0, 0);
    }*/
    /**
     * one
     *
     * @return static
     */
    /*public function one()
    {
        return new static(1, 0);
    }*/
    /**
     * ten
     *
     * @return static
     */
    /*public function ten()
    {
        return new static(10, 0);
    }*/
    
    public function value()
    {
        return $this->value;
    }
    /**
     * @return int
     */
    public function scale()
    {
        return $this->scale;
    }
    /**
     * @param $scale
     * @return static
     * @throws \InvalidArgumentException
     */
    public function setScale($scale, $roundingMode = null)
    {
    	if($roundingMode == null) return new static($this->value, $scale);
    	else return $this->doround($scale, $roundingMode);
    }
    public function precision()
    {
        $parts = explode('.', $this->value);
        return strlen(ltrim($parts[0], '-'));
    }
    public function __toString()
    {
        return $this->value();
    }
    public function toString()
    {
        return $this->value();
    }
    /**
     * @param BigDecimal $addend
     *
     * @return static
     */
    public function add(BigDecimal $addend)
    {
        $scale = max($this->scale(), $addend->scale());
        return new static(bcadd($this->value, $addend->value(), $scale), $scale);
    }
    /**
     * @param BigDecimal $subtrahend
     *
     * @return static
     */
    public function subtract(BigDecimal $subtrahend)
    {
        $scale = max($this->scale(), $subtrahend->scale());
        return new static(bcsub($this->value, $subtrahend->value(), $scale), $scale);
    }
    /**
     * @param BigDecimal $multiplier
     *
     * @return static
     */
    public function multiply(BigDecimal $multiplier)
    {
        $value = bcmul($this->value, $multiplier->value(), 64);
        $value = explode('.',$value);
        $fraction = count($value) == 1 ? '' : rtrim($value[1], '0');
        $scale = strlen($fraction);
        $value = $value[0] . (strlen($fraction) == 0 ? '' : '.' . $fraction);
        return new static($value,$scale);
    }
    /**
     * @param BigDecimal $divisor
     *
     * @return BigDecimal
     * @throws \InvalidArgumentException
     */
    public function divide(BigDecimal $divisor, $scale = null, $roundingMode = null)
    {
        if ($divisor->signum() === 0) {
            throw new \InvalidArgumentException('Division by zero');
        }
        $value = bcdiv($this->value, $divisor->value(), 64);
        $value = explode('.',$value);
        $fraction = count($value) == 1 ? '' : rtrim($value[1], '0');
        $value = $value[0] . (strlen($fraction) == 0 ? '' : '.' . $fraction);
        if(!(is_int($scale) && $scale >= 0)) {
        	$scale = strlen($fraction);
        }
        if($roundingMode == null) return new static($value, $scale);
        else return (new static($value))->doround($scale, $roundingMode);
    }
    
    public function doround($scale, $roundMode)
    {
    	$value = bcmul($this->value,pow(10,$scale),64);
    	switch($roundMode) {
    		case self::$ROUND_UP:
    			$value = ceil($value);
    			break;
    		case self::$ROUND_DOWN:
    			$value = floor($value);
    			break;
    	}
    	return new static(bcdiv($value,pow(10,$scale),$scale),$scale);
    }
    /**
     * @param $n
     *
     * @return static
     * @throws \InvalidArgumentException
     */
    public function pow($n)
    {
        $n = (int) $n;
        if ($n < 0) {
            throw new \InvalidArgumentException(sprintf('Power "%s" is negative', $n));
        }
        if ($n === 0) {
            return static::one();
        }
        return new static(bcpow($this->value, $n, self::$MAX_SCALE));
    }
    /**
     * @return int
     */
    public function signum()
    {
        return $this->compareTo(self::ZERO());
    }
    /**
     * @return static
     */
    public function negate()
    {
        $value = $this->value;
        switch ($this->signum()) {
            case -1:
                $value = substr($value, 1);
                break;
            case 1:
                $value = '-'. $value;
                break;
        }
        return new static($value, $this->scale);
    }
    /**
     * @return static
     */
    public function abs()
    {
        return $this->signum() < 0 ? $this->negate() : new static($this->value, $this->scale);
    }
    /**
     * @param int $scale
     * @param int $roundMode
     *
     * @return static
     * @throws \RuntimeException If round mode is UNNECESSARY and digit truncation is required
     */
    public function round($scale = 0, $roundMode = null)
    {
    	if($roundMode == null) $roundMode = self::$ROUND_HALF_UP;
        if ($scale >= $this->scale) {
            return new static($this->value, $scale);
        }
        // Break string to 2 parts. Ex '123.45678', 3: '123.456' and '78'
        list($newValue, $truncated) = str_split($this->value, strlen($this->value) - ($this->scale - $scale));
        // Remove trailing dot for integer round
        if ($scale === 0) {
            $newValue = substr($newValue, 0, -1);
        }
        // remove extra zeros
        $truncated = rtrim($truncated, '0');
        // Check if truncated digits are zeros, than no rounding required
        if ($truncated === '') {
            return new static($newValue, $scale);
        }
        // If we should not round but got some truncated digits
        if ($roundMode === self::$ROUND_UNNECESSARY) {
            throw new \RuntimeException(sprintf('Digits "%s" of "%s" should not be truncated with scale "%d"', $truncated, $this->value, $scale));
        }
        $rounded = new static($newValue, $scale);
        $sign = $this->signum() !== -1;
        if (self::isRoundAdditionRequired($roundMode, $sign, $newValue, $truncated)) {
            // If addition required we add (+/-)1E-{scale}
            $addition = ($sign ? '': '-').'1e-'.$scale;
            $rounded = $rounded->add(new static(number_format($addition, $scale, '.', '')));
        }
        return $rounded;
    }
    /**
     * @param $roundMode
     * @param $sign
     * @param $value
     * @param $truncated
     * @return bool
     */
    private static function isRoundAdditionRequired($roundMode, $sign, $value, $truncated)
    {
        switch ($roundMode) {
            case self::$ROUND_UP:
                return true;
            case self::$ROUND_DOWN:
                return false;
            case self::$ROUND_CEILING:
                return $sign;
            case self::$ROUND_FLOOR:
                return !$sign;
            case self::$ROUND_HALF_UP:
                return $truncated === '5' || $truncated[0] >= 5 ;
            case self::$ROUND_HALF_DOWN:
                return !($truncated === '5' || $truncated[0] < 5 );
            case self::$ROUND_HALF_EVEN:
                return !($truncated[0] < 5 || ($truncated === '5' && ($value[strlen($value)-1] % 2 === 0)));
            case self::$ROUND_HALF_ODD:
                return !($truncated[0] < 5 || $truncated === '5' && ($value[strlen($value)-1] % 2 === 1));
        }
        return false;
    }
    /**
     * @param BigDecimal $number
     * @return int
     */
    public function compareTo($number)
    {
    	//$number = new BigDecimal($number);
        $scale = max($this->scale(), $number->scale());
        return bccomp($this->value, $number->value(), $scale);
    }
    /**
     * @param BigDecimal $number
     * @return bool
     */
    public function isEqualTo(BigDecimal $number)
    {
        return $this->compareTo($number) == 0;
    }
    /**
     * @param BigDecimal $number
     * @return bool
     */
    public function isGreaterThan(BigDecimal $number)
    {
        return $this->compareTo($number) == 1;
    }
    /**
     * @param BigDecimal $number
     * @return bool
     */
    public function isGreaterThanOrEqualTo(BigDecimal $number)
    {
        return $this->compareTo($number) >= 0;
    }
    /**
     * @param BigDecimal $number
     * @return bool
     */
    public function isLessThan(BigDecimal $number)
    {
        return $this->compareTo($number) == -1;
    }
    /**
     * @param BigDecimal $number
     * @return bool
     */
    public function isLessThanOrEqualTo(BigDecimal $number)
    {
        return $this->compareTo($number) <= 0;
    }
    /**
     * @return bool
     */
    public function isNegative()
    {
        return $this->isLessThan(static::zero());
    }
    /**
     * @return bool
     */
    public function isPositive()
    {
        return $this->isGreaterThan(static::zero());
    }
    /**
     * 
     */
    public static function valueOf($value) {
    	return new static($value);
    }
}

?>