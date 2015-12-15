<?PHP

require_once 'adlister_login.php';
require_once 'db_connect.php';

$clearData = 'TRUNCATE ads';

$dbc->exec($ads)

$ads = [
    ['adTitle' => 'Dryer',   'adPrice' => 'two-fiddy', 'adlocation' =>  'Austin, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],
    
    ['adTitle' => 'hanger',   'adPrice' => '70', 'adlocation' =>  'Bucktown, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'used sock',   'adPrice' => 'tree-fiddy', 'adlocation' =>  'Dee Eff Dub, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'Fake Jays',   'adPrice' => '$53.27', 'adlocation' =>  'Austin, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'Bbq pit',   'adPrice' => '$250', 'adlocation' =>  'Lockhart, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'Dryer',   'adPrice' => 'two-fiddy', 'adlocation' =>  'Austin, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'bird\'s nest',   'adPrice' => '$0.50', 'adlocation' =>  'San Antonio, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.'],

    ['adTitle' => 'Cat',   'adPrice' => 'FREE', 'adlocation' =>  'Alamo Heights, TX', 'adDescrip' => ['Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway.']
];

$query = "INSERT INTO ads (adTitle, adPrice, adLocation, AdDescription) 
			VALUES (:adTitle, 
    			:adPrice, 
    			:adLocation, 
    			:adDescrip)";


$stmt = $dbc->prepare($query);

foreach ($ads as $ad) {
	$stmt->bindValue(':adTitle', $ad['adTitle'], PDO::PARAM_STR);
	$stmt->bindValue(':adPrice', $ad['adPrice'], PDO::PARAM_STR);
	$stmt->bindValue(':adLocation', $ad['adLocation'], PDO::PARAM_STR);
	$stmt->bindValue(':adDescrip', $ad['adDescrip'], PDO::PARAM_STR);
	$stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

echo $dbc->getAttribute(PDO::ATTR_CONECTION_STATUS) . "\n";