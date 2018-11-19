<?php

include 'controller/controller.php';

class DeleteCashFlowCOntroller extends controller
{
	public function delete()
	{
        $model = $this->loadModel('deleteCashFlow');
        $model->delete($_GET['id']);
        $this->redirect('?task=showBalance&action=index');
    }
}