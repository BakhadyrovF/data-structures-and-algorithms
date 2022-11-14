<?php

class MyHashTable
{
    private array $data = [];
    private int $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function data()
    {
        $data = [];
        /** Using foreach() instead of for(), because indexes might have missing */
        foreach ($this->data as $bucket) {
            /** Using nested loop because we might have hash-table collision */
            foreach ($bucket as $keyValue) {
                $data[$keyValue[0]] = $keyValue[1];
            }
        }

        return $data;
    }

    public function keys()
    {
        $keys = [];

        /** Using foreach() instead of for(), because indexes might have missing */
        foreach ($this->data as $bucket) {
            /** Using nested loop because we might have hash-table collision */
            foreach ($bucket as $keyValue) {
                $keys[] = $keyValue[0];
            }
        }

        return $keys;
    }

    public function set($key, $value)
    {
        $hashCode = $this->hash($key);

        if (empty($this->data[$hashCode])) {
            $this->data[$hashCode] = [];
        }

        $this->data[$hashCode][] = [$key, $value];
    }

    public function get($key)
    {
        $bucket = $this->data[$this->hash($key)] ?? null;

        if (!$bucket) {
            return null;
        }

        /** Using foreach() instead of for(), because indexes might have missing */
        foreach ($bucket as $keyValue) {
            if ($keyValue[0] === $key) {
                return $keyValue[1];
            }
        }

        return null;
    }

    public function delete($key)
    {
        $hashCode = $this->hash($key);

        if (empty($this->data[$hashCode])) {
            return false;
        }

        /** Using foreach() instead of for(), because indexes might have missing */
        foreach ($this->data[$hashCode] as $index => $keyValue) {
            if ($keyValue[0] === $key) {
                unset($this->data[$hashCode][$index]);
                return true;
            }
        }


        return false;
    }

    private function hash($key)
    {
        $hash = 0;
        for ($i = 0; $i < strlen($key); $i++) {
            $hash = ($hash + ord(substr($key, $i, 1)) * $i) % $this->size;
        }

        return $hash;
    }
}

$tinyHashTable = new MyHashTable(2);

$tinyHashTable->set('grapes', 10_000); // hashCode is 1
$tinyHashTable->get('grapes'); // 10000

$tinyHashTable->set('has_grapes', 'yes'); // hashCode is 1
$tinyHashTable->get('has_grapes'); // yes

$tinyHashTable->delete('has_grapes'); // true
$tinyHashTable->get('grapes'); // 10000
$tinyHashTable->get('has_grapes'); // null

$myHashTable = new MyHashTable(50);
$myHashTable->set('age', 19);
$myHashTable->set('name', 'Firuzbek');
$myHashTable->set('hobby', 'Table Tennis');

$myHashTable->keys(); // [age, name, hobby];
$myHashTable->data(); // [age => 19, name => Firuzbek, hobby => Table Tennis]