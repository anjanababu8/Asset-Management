<?php
class SampleController extends Controller {

    public function actionGetorg() {
        $name = $_GET['name'];

        $user = User::model()->findByAttributes(array('name'=>$name));
        $orgId = $user['organisation_id'];
   
        $org = Organisation::model()->findByPk($orgId);
        $orgName = $org['name'];
        ?>

        <option value="<?php echo $orgId; ?>"><?php echo $orgName; ?></option>

        <?php
    }   
}
?>