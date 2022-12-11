<?php

/**
 * Merge Two Sorted Lists
 * @link https://leetcode.com/problems/merge-two-sorted-lists
 *
 * Solution - O(n)
 *
 * Steps:
 * 1. Checks for empty inputs
 * 2. Initialize new ListNode object with the lowest value of given lists
 * 3. Assign a reference for $mainList object to variable $result, so we can return object at the end
 * 4. Iterate through each element of both arrays until both of nodes are not null
 * 5. Check if $list1, $list2 are exists and $list1->val is lower than $list2->val,
 * then initialize a new ListNode object with $list->val value and assign reference for newly initialized object to $mainList->next property
 * 6. Change current $mainList reference to it's next object ($mainList->next) so we can change it in next iteration
 * 7. Otherwise, do opposite of 5th step
 * 8. Return $result;
 */

/**
 * Definition for a singly-linked list.
 */
class ListNode
{
     public $val = 0;
     public $next = null;
     function __construct($val = 0, $next = null) {
         $this->val = $val;
         $this->next = $next;
     }
}

function mergeTwoLists($list1, $list2) {
    if (is_null($list1->val)) {
        return $list2;
    } elseif (is_null($list2->val)) {
        return $list1;
    }

    if ($list1->val < $list2->val) {
        $mainList = new ListNode($list1->val);
        $list1 = $list1->next;
    } else {
        $mainList = new ListNode($list2->val);
        $list2 = $list2->next;
    }

    $result = $mainList;

    while ($list1 || $list2) {
        if (!$list2 || ($list1 && $list1->val < $list2->val)) {
            $mainList->next = new ListNode($list1->val);
            $mainList = $mainList->next;
            $list1 = $list1->next;
        } else {
            $mainList->next = new ListNode($list2->val);
            $mainList = $mainList->next;
            $list2 = $list2->next;
        }
    }

    return $result;
}