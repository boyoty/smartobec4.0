[
	{"key": "department", "title": "หน่วยงาน", "folder": true, "children": [
	<?php 
	$parent = '';
	foreach ($department_group_used as $row_dg) {
		if($parent!='')$parent=$parent.',';
		$parent = $parent.'{"title": "'.$row_dg->department_groupname.'", "folder": true';
		$this->load->model('IofficeModel');
		$node = $this->IofficeModel->get_node_group($row_dg->department_groupid);
		if($node!=false) {
			$parent = $parent.', "children": [';
			$child = '';
			foreach ($node as $row_node) {
				if($child!=''){$child=$child.',';}
				$child = $child.'{"key": "'.$row_node->nodeid.'", "title": "'.$row_node->nodename.'"}';
			}
			$parent = $parent.$child.']';

		}
		$parent = $parent.'}';		
	}
	echo $parent;
	?>
	]},

	{"key": "person", "title": "บุคคล", "folder": true, "children": [
		{"key": "20_1", "title": "Sub-item 2.1", "children": [
			{"key": "20_1_1", "title": "Sub-item 2.1.1"},
			{"key": "20_1_2", "title": "Sub-item 2.1.2"}
		]},
		{"key": "20_2", "title": "Sub-item 2.2", "children": [
			{"key": "20_2_1", "title": "Sub-item 2.2.1"},
			{"key": "20_2_2", "title": "Sub-item 2.2.2"}
		]}
	]}
]