<?php

include 'view/view.php';

class ShowBalanceView extends View
{
	public function index()
	{
		$balanceData = $this->loadModel('showBalance');
		$table = $balanceData->showBalance();
		$this->set('all_incomes', $table['all_incomes']);
		$this->set('grouped_incomes', $table['grouped_incomes']);
		$this->set('incomes_sum', $table['incomes_sum']);
		$this->set('all_expenses', $table['all_expenses']);
		$this->set('grouped_expenses', $table['grouped_expenses']);
		$this->set('expenses_sum', $table['expenses_sum']);	

		$this->render('balanceSheet');
	}

    public function printTable($allData)
	{
		if($allData == 'all_incomes'){
			$dataType = 'incomes';
			$viewType = 'Income';
		} else if($allData == 'all_expenses'){
			$dataType = 'expenses';
			$viewType = 'Expense';
		}

		$i=1;
		foreach($this->get($allData) as $data)
		{
			echo
			'<tr>
				<th class="tableInput" scope="row">' . $i .'</th>
				<td class="tableInput date">' . $data['date'] . '</td>
				<td class="tableInput amount">' . $data['amount'] . '</td>
				<td class="tableInput category">' . $data['name'] . '</td>
				<td class="tableInput comment">' . $data['comment'] . '</td>
				<td class="tableInput">
				    <a id="edit" href="?task=edit&action=edit' . $viewType  . 'View&type=' . $dataType . '&id=' . $data['id'] . '">EDYTUJ</a>  
				    <a id="delete" href="?task=delete&action=delete&type=' . $dataType . '&id=' . $data['id'] . '">USUŃ</a>
				</td>
			</tr>';
			$i++;
		}
	}

	public function printTotals($totals)
	{
		foreach($this->get($totals) as $total){echo $total['total'] . ' zł';}
	}

	public function fillChartLabels($all_grouped_by)
	{ 
		foreach($this->get($all_grouped_by) as $single_data)
			echo " ' " . $single_data['name'] . " ' ,";
	}

	public function fillChartData($all_grouped_by)
	{ 
		foreach($this->get($all_grouped_by) as $single_data)
			echo " ' " . $single_data['total'] . " ' ,";
	}
}