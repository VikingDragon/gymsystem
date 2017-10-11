<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        /*// agrega el permiso "editarDatos" 
        $editarDatos = $auth->createPermission('editarDatos');
        $editarDatos->description = 'Permite editar datos de un usuario';
        $auth->add($editarDatos);

        // add "author" role and give this role the "createPost" permission
        $misDatos = $auth->createRole('misDatos');
        $auth->add($misDatos);
        $auth->addChild($misDatos, $editarDatos);*/

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);
        //$auth->addChild($administrador, $updatePost);
        //$auth->addChild($administrador, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        //$auth->assign($author, 2);
        $auth->assign($administrador, 1);
    }
}