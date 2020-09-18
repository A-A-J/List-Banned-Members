<?php

/*
| Control the number of pages on the tables page and more.

| Steps to use for the pagination plugin:-
    [1] - Call Up [$pagination = new pagination();] In the page used.

    [2] - Then after that it is called under the previous step:
        [$pagination_page = ($pagination->get_pay_numper() > 1 ) ? ($pagination->get_pay_numper() * $pagination->get_page_limit() ) - $pagination->get_page_limit(): 0 ;].

    [3] - It is then used under the previous step: [$getTableSelectPagesHome = getAllTableLimit('*', 'members', $pagination_page , $pagination->get_page_limit());]
        Note that the code is: [$getTableSelectPagesHome] It is used inside embedding [foreach].

    [4] - Now to show the buttons, inclusions must be added at the end of the page or after table [$pagination->get_page_id('id','table_table_table');]
        A table is defined by replacing [table_table_table].

    [5] - Now you must show the buttons using the following code: [echo $pagination->paginationfull($menupageurl);].

| If you do not understand the syntax explanation, see any sheet that contains buttons. You will find the previous encodings similar to what inside [].

| Built, explained, coded, and queryed by Gapri, I will not forgive anyone who steals, claims, brags, or proves that it is not for Basho.
  You can request help or inquiries via my e-mail, which is: uuu99199@gmail.com.

| Version: 1.0

*/

class pagination{
	private $limit = 0;
	private $page_numbesr = 'page_home';
	private $page_number;
	private $get_page_id = 0;

	public function get_pay_numper(){
		return $this->page_number = isset($_GET[$this->page_numbesr]) && is_numeric(getInject($_GET[$this->page_numbesr])) ? intval(getInject($_GET[$this->page_numbesr])):0;
	}

	
	public function get_page_limit(){
		return $this->limit = 5;
	}


	public function get_page_id($field, $table, $condition = null){
		global $con;
		$getAll = $con->prepare("SELECT count($field) AS $field FROM $table $condition");
		$getAll->execute();
		$runa10 = $getAll->fetch();
		return $this->get_page_id = $runa10['id'];
	}

	public function paginationfull($link_page){
		$limit	= $this->limit;
		$rows = $this->get_page_id;
		$page_number = $this->page_number;
		$pagination_buttons = 5;
		$last_page			= ceil($rows/$limit);
		if($page_number > $last_page){
			header( 'Location: ?page='.$link_page.'&'.$this->page_numbesr.'='.$last_page.'' );
		}elseif($page_number == 0){
			header( 'Location: ?page='.$link_page.'&'.$this->page_numbesr.'=1' );
		}
		$pagination			= '';
		$pagination		   .= '<nav id="pagination" aria-label="Page navigation example"><ul>';
		if($page_number < 1 ){
			$page_number = 1;
		}elseif($page_number > $last_page ){
			$page_number = $last_page;
		}
		$pagination_partition_assistant = floor($pagination_buttons / 2);
		if($page_number <= $pagination_buttons AND ($last_page == $pagination_buttons OR $last_page <= 25)){
			for($i_page=1; $i_page<=$last_page; $i_page++){
                if($last_page > 1){
                    if($i_page <= 5){
                        if ($i_page == $page_number){
                            $pagination	.= '<li class="page-item active"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
                        }else{
                            
                            $pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
                        }
                    }
                }
			}
			if($last_page > $pagination_buttons ){
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.($pagination_buttons+1).'">'.Lang['Next'].'</a></li>';
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$last_page.'">'.Lang['Last'].'</a></li>';
			}
		}elseif($page_number >= $pagination_buttons AND $last_page > $pagination_buttons){
			
			if(($page_number+$pagination_partition_assistant) >= $last_page){
	
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'=1">'.Lang['First'].'</a></li>';
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.($last_page-$pagination_buttons).'">'.Lang['Previous'].'</a></li>';
	
				for($i_page=($last_page-$pagination_buttons)+1; $i_page<=$last_page;$i_page++){
					if ($i_page == $page_number){
						$pagination	.= '<li class="page-item active"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
					}else{
						$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
					}
				}
			
			}elseif(($page_number+$pagination_partition_assistant) < $last_page){
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'=1">'.Lang['First'].'</a></li>';
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.(($page_number-$pagination_partition_assistant)-1).'">'.Lang['Previous'].'</a></li>';
	
				for($i_page=($page_number-$pagination_partition_assistant); $i_page<=($page_number+$pagination_partition_assistant);$i_page++){
					if ($i_page == $page_number){
						$pagination	.= '<li class="page-item active"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
					}else{
						$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$i_page.'">'.$i_page.'</a></li>';
					}
				}
	
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.(($page_number+$pagination_partition_assistant)+1).'">'.Lang['Next'].'</a></li>';
				$pagination	.= '<li class="page-item"><a class="page-link" href="?page='.$link_page.'&'.$this->page_numbesr.'='.$last_page.'">'.Lang['Last'].'</a></li>';
	
			}
		}
		$pagination		   .= '</ul></nav>';
		return $pagination;
	}
}