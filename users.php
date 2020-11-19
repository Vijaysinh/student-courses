<?php 
    //error_reporting(E_ALL);
    //ini_set('display_errors',1);

    require_once 'core/init.php';
	$pagination =  new Pagination('students');
	$users = $pagination->get_data();
    $pages	= $pagination->get_pagination_number();

    //pr($users->results());exit;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pagination PDO Class</title>
	<style type="text/css">
		.active{
			background: rgb(23, 169, 201);
			color: white;
		}
	</style>
</head>
<body>	
	<table class="table table-bordered">
                    <thead>
                        <tr>
                        <th></th>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">ID</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($users->results() as $v){?>
                        <tr>
                            <td><a href="tex">Edit</a></td>
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $v->fname;?></td>
                            <td><?php echo $v->lname;?></td>
                            <td><?php echo $v->id;?></td>
                            <td><a href="tex">Delete</a></td>
                        </tr>
                        
                    <?php $i++;}?>
                    </tbody>
                    </table>
	<hr>
	<a href="?page=<?php echo $pagination->prev_page().''.$pagination->check_search();?>"> << </a>
		<?php for($i=1; $i<=$pages; $i++): ?>
			<?php if($pagination->is_showable($i)):?>
				<a class="<?php echo $pagination->is_active_class($i) ?>" href="?page=<?php echo $i.''.$pagination->check_search(); ?>"><?php echo $i;?></a>
			<?php endif; ?>
		<?php endfor; ?>
	<a href="?page=<?php echo $pagination->next_page().''.$pagination->check_search();?>"> >> </a>
</body>
</html>
