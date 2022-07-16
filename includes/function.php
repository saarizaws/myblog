<?php
    function getCategory($db,$id){
        $query="SELECT * FROM category WHERE id=$id";
        $run=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($run);
        return $data['name'];
    }

    function getImagesByPost($db,$post_id){
        $query="SELECT * FROM images WHERE post_id=$post_id";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
}
    function getParasByPost($db,$post_id){
        $query="SELECT * FROM paras WHERE post_id=$post_id";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
}

    function getSubMenu($db,$menu_id){
        $query="SELECT * FROM submenu WHERE parent_menu_id=$menu_id";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
}

    function getSubMenuNo($db,$menu_id){
        $query="SELECT * FROM submenu WHERE parent_menu_id=$menu_id";
        $run=mysqli_query($db,$query);
        return mysqli_num_rows($run);
}

?>