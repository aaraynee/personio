<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HierarchyController extends Controller
{
    /**
     * Get JSON Post data and Create Hierarchy
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $relationships = $request->all();
        $boss = $this->getBoss($relationships);
        // If no boss then loop must exist.
        if($boss) {
            $structure = [];
            foreach ($relationships as $child => $parent) {
                if (!array_key_exists($parent, $structure)) {
                    $structure[$parent] = [];
                }
                $structure[$parent][] = $child;
            }

            return $this->generateHierarchy($relationships, $boss);
        } else {
            return ['Loop exists'];
        }
    }

    /**
     * Generate Children for Current Parent
     * @param $data
     * @param $parent
     * @return mixed
     */
    function generateHierarchy($data, $parent)
    {
        $tree[$parent] = [];
        foreach($data as $child => $cur_parent) {
            if($cur_parent == $parent) {
                $tree[$parent][] = $this->generateHierarchy($data, $child);
            }

        }
        return $tree;
    }

    /**
     *  Get boss, as there is only one boss any employee that does not have a parent will be boss.
     * @param $relationships
     * @return string
     */
    function getBoss($relationships)
    {
        $supervisors = [];
        $employees = [];
        foreach($relationships as $child => $parent) {
            $supervisors[] = $parent;
            $employees[] = $child;
        }
        $boss = array_unique(array_diff($supervisors, $employees));
        return implode("", $boss);
    }
}