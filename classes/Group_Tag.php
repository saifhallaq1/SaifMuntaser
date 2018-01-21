<?php
/**
 * Created by PhpStorm.
 * User: Muntaser
 * Date: 1/6/2018
 * Time: 4:28 PM
 */

class Group_Tag
{
    protected $g_t_id;
    protected $group;
    protected $tag;

    /**
     * @return mixed
     */
    public function getG_t_Id()
    {
        return $this->g_t_id;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    public function checkTagIfExist($sent_group, $sent_tag){
        global $database;
        $sql = "SELECT * FROM groups_tags WHERE group_id = '$sent_group' AND tag_id = '$sent_tag' ";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if ($result){
            $this->getMessage("tag is exist for group ");
            return $result;
        }else{
            $this->getMessage("tag isn't exist for group ");
            return 0;
        }
    }

    public function addTagForGroup($sent_group, $sent_tag){
        global $database;

        $sql = "INSERT INTO groups_tags(group_id, tag_id) VALUES('$sent_group', '$sent_tag') ";

        $resultSet = $database->query($sql);
        if ($database->affectedRows($resultSet)){
            $this->getMessage("addTagForGroup worked ".$sent_tag);
            return 1;
        }else{
            $this->getMessage("addTagForGroup didnt work ".$sent_tag);
            return 0;
        }
    }

    public function getTagsByGroupId($sent_group){
        global $database;
        $sql = "SELECT * FROM groups_tags WHERE group_id = '$sent_group'";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if($result){
            $this->getMessage("tags have been fetched from DB for group!");
            $tags = array();

            while($row = $resultSet->fetch_assoc()){

                // add each row returned into an array
                $tags[] = $row;
            }
            return $tags;
        }else{

            $this->getMessage("addTagForGroup didnt fetch from DB for Questions!");
            return 0;
        }
    }

    public function deleteTag($sent_group_id, $sent_tag_id){
        global $database;
        $sql = "DELETE FROM groups_tags WHERE group_id= '$sent_group_id' AND tag_id = '$sent_tag_id' ";
        $resultSet = $database->query($sql);
        if($database->affectedRows($resultSet)){
            return true;
        }else{
            return false;
        }
    }

    protected function getMessage($msg){
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }


    public function sanitize($input){
        global $database;

        $sanitizedInput = $database->escapeString(trim($input));
        return $sanitizedInput;
    }


}