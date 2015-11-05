<?php
interface iBusinessObject
{
    public static function retrieveSome($start,$count);
    public static function SearchActor($Name);
    public static function SearchUActor($actorId);
    public static function DeleteActor($ActorId);
    public static function UpdateActor($UpActor, $first, $last);

    public function save();
}
?>
