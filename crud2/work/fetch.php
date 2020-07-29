<?php

if($_POST['remove'] == 'removing') {
	$data = $_POST;

	$api_url = "files/people.json";
	$json = file_get_contents($api_url);
	$result = json_decode($json, true);

	foreach($result as $key => $value){
		if($value['name'] == $data['name']) {
			unset($result[$key]);
		}
	}

	$i = 0;
	foreach($result as $key => $value){
		$people[$i] = $value;
		$i++;
	}

	file_put_contents('files/people.json', json_encode($people));

	echo json_encode(['success', 'Remoção concluída com sucesso!']);
	exit();
}

if($_POST) {
	$data = $_POST;

	$api_url = "files/people.json";
	$json = file_get_contents($api_url);
	$result = json_decode($json, true);

	foreach($result as $key => $value)
	{
		if($value['name'] == $data['Nome']) {
			$result[$key]['name'] = $data['NameEdit'];
			$result[$key]['gender'] = $data['GenderEdit'];
			$result[$key]['birth_year'] = $data['BYEdit'];
			$result[$key]['eye_color'] = $data['EyeColorEdit'];
			$result[$key]['hair_color'] = $data['HairColorEdit'];
			$result[$key]['height'] = $data['HeightEdit'];
		}
	}

	file_put_contents('files/people.json', json_encode($result));

	echo json_encode(['success', 'Edição concluída com sucesso!']);
	exit();
}

if (!file_exists('files/people.json')) {
	$api_url = "https://swapi.dev/api/people/";
	$json = file_get_contents($api_url);
	$result = json_decode($json);

	function getPeople($url) {
		$api = $url;
		$jsonP = file_get_contents($api);
		$resultP = json_decode($jsonP);

		return $resultP;
	}

	$i = 0;

	while($result->next != null) 
	{
		foreach($result->results as $key => $value)
		{
			$people[$i] = (array) $value;
			$i++;
		}
		$result = getPeople($result->next);
	}

	file_put_contents('files/people.json', json_encode($people));
} else {
	$api_url = "files/people.json";
	$json = file_get_contents($api_url);
	$result = json_decode($json);

	foreach($result as $key => $value)
		{
			$people[$key] = (array) $value;
		}
}

$output = '';

if($people)
{
	foreach($people as $key => $value)
	{
		$output .= '
		<tr>
			<td>'.$value['name'].'</td>
			<td>'.$value['gender'].'</td>
			<td>'.$value['birth_year'].'</td>
			<td><button type="button" name="info" class="btn btn-info btn-xs info" 
				data-id="'.$value['url'].'" 
				data-name="'.$value['name'].'"
				data-eye="'.$value['eye_color'].'"
				data-hair="'.$value['hair_color'].'"
				data-height="'.$value['height'].'">More Info</button>
				
				<button type="button" name="edit" class="btn btn-info btn-xs edit" 
				data-id="'.$value['url'].'" 
				data-nome="'.$value['name'].'"
				data-name="'.$value['name'].'"
				data-gender="'.$value['gender'].'"
				data-by="'.$value['birth_year'].'"
				data-eye="'.$value['eye_color'].'"
				data-hair="'.$value['hair_color'].'"
				data-height="'.$value['height'].'">Edit</button>

				<button type="button" name="remove" class="btn btn-danger btn-xs remove" 
				data-id="'.$value['name'].'">Remove</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>