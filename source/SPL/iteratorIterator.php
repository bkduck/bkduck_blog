<?php
 
class Enumerator extends IteratorIterator
 {    
    /**
     * Initial value for enumerator
     * @param int  
    */
     protected $start = 0;
 
    /**
     * @param int
     */
     protected $key = 0;
 
    /**
     * @param Traversable $iterator
     * @param scalar $start
     */
     public function __construct(Traversable $iterator, $start = 0)
     {
         parent::__construct($iterator);
 
        $this->start = $start;
 
        $this->key = $this->start;
     }
 
    public function key()
     {
         return $this->key;
     }
 
    public function next()
     {
         ++$this->key;
 
        parent::next();
     }
 
    public function rewind()
     {
         $this->key = $this->start;
 
        parent::rewind();
     }
 
}

 
$enumerator = new Enumerator(
        new ArrayIterator(['php', 'java', 'python']), 7000
 );
 
print_r(iterator_to_array($enumerator));
 
/* 输出
 *    array(3) { 
           7000 => 'php',
            7001 => 'java',
            7002 => 'python'
      }
 */
 
?> 