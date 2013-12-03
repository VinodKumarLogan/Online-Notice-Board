<html>
<style type="text/css">
input.butt
{
    background: #0A84FF;
   background: -webkit-gradient(linear, left top, left bottom, from(#B43104), to(#1C1C1C));
   background: -webkit-linear-gradient(top, #419AFB, #7EA3FF);
   background: -moz-linear-gradient(top, #419AFB, #7EA3FF);
   background: -ms-linear-gradient(top, #419AFB, #7EA3FF);
   background: -o-linear-gradient(top, #419AFB, #7EA3FF);
   padding: 1px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
}
</style>
</html>



<?php

class block_settings_renderer extends plugin_renderer_base {

    public function settings_tree(settings_navigation $navigation) {
        $count = 0;
        foreach ($navigation->children as &$child) {
            $child->preceedwithhr = ($count!==0);
            $count++;
        }
        $content = $this->navigation_node($navigation, array('class'=>'block_tree list'));
        if (isset($navigation->id) && !is_numeric($navigation->id) && !empty($content)) {
            $content = $this->output->box($content, 'block_tree_box', $navigation->id);
        }
        return $content;
    }

    protected function navigation_node(navigation_node $node, $attrs=array()) {
        $items = $node->children;

        // exit if empty, we don't want an empty ul element
        if ($items->count()==0) {
            return '';
        }

        // array of nested li elements
        $lis = array();
        foreach ($items as $item) {
            if (!$item->display) {
                continue;
            }

            $isbranch = ($item->children->count()>0  || $item->nodetype==navigation_node::NODETYPE_BRANCH);
            $hasicon = (!$isbranch && $item->icon instanceof renderable);

            if ($isbranch) {
                $item->hideicon = true;
            }
            $content = $this->output->render($item);

            // this applies to the li item which contains all child lists too
            $liclasses = array($item->get_css_type());
            if (!$item->forceopen || (!$item->forceopen && $item->collapse) || ($item->children->count()==0  && $item->nodetype==navigation_node::NODETYPE_BRANCH)) {
                $liclasses[] = 'collapsed';
            }
            if ($isbranch) {
                $liclasses[] = 'contains_branch';
            } else if ($hasicon) {
                $liclasses[] = 'item_with_icon';
            }
            if ($item->isactive === true) {
                $liclasses[] = 'current_branch';
            }
            $liattr = array('class'=>join(' ',$liclasses));
            // class attribute on the div item which only contains the item content
            $divclasses = array('tree_item');
            if ($isbranch) {
                $divclasses[] = 'branch';
            } else {
                $divclasses[] = 'leaf';
            }
            if (!empty($item->classes) && count($item->classes)>0) {
                $divclasses[] = join(' ', $item->classes);
            }
            $divattr = array('class'=>join(' ', $divclasses));
            if (!empty($item->id)) {
                $divattr['id'] = $item->id;
            }
            $content = html_writer::tag('p', $content, $divattr) . $this->navigation_node($item);
            if (!empty($item->preceedwithhr) && $item->preceedwithhr===true) {
                $content = html_writer::empty_tag('hr') . $content;
            }
            $content = html_writer::tag('li', $content, $liattr);
            $lis[] = $content;
        }

        if (count($lis)) {
            return html_writer::tag('ul', implode("\n", $lis), $attrs);
        } else {
            return '';
        }
    }

    public function search_form(moodle_url $formtarget, $searchvalue) {
        $content = html_writer::start_tag('form', array('class'=>'adminsearchform', 'method'=>'get', 'action'=>$formtarget));
        $content .= html_writer::start_tag('div');
        $content .= html_writer::tag('label', s(get_string('searchinsettings', 'admin')), array('for'=>'adminsearchquery', 'class'=>'accesshide'));
        $content .= html_writer::empty_tag('input', array('id'=>'adminsearchquery', 'type'=>'text', 'name'=>'query', 'value'=>s($searchvalue)));
        $content .= html_writer::empty_tag('input', array('class'=>'butt', 'type'=>'submit', 'value'=>s(get_string('search'))));
        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('form');
        return $content;
    }

}
