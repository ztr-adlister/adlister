<?PHP

require_once 'adlister_login.php';
require_once 'db_connect.php';

$clearData = 'TRUNCATE ads';

$dbc->exec($clearData);

$ads = [
    ['title' => 'Dryer',   'price' => '50', 'location' =>  'Austin, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...', ],
    
    ['title' => 'hanger',   'price' => '70', 'location' =>  'Bucktown, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'used sock',   'price' => '60', 'location' =>  'Dee Eff Dub, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'Fake Jays',   'price' => '53.27', 'location' =>  'Austin, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'Bbq pit',   'price' => '250', 'location' =>  'Lockhart, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'Dryer',   'price' => '2.50', 'location' =>  'Austin, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'bird\'s nest',   'price' => '0.50', 'location' =>  'San Antonio, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-scoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...'],

    ['title' => 'Cat',   'price' => '0.00', 'location' =>  'Alamo Heights, TX', 'description' => 'Acadia National Park is a 47,000-acre Atlantic coast recreation area primarily on Maine\'s Mount Desert Island. Its landscape is marked by woodland, rocky beaches and glacier-https://github.com/ztr-adlister/adlisterscoured granite peaks like Cadillac Mountain, the highest point on the United States’ East Coast. Among the wildlife are moose, bear, whales and seabirds. The bayside town of Bar Harbor, with restaurants and shops, is a popular gateway', 'image_url'=>'...']
];

$query = "INSERT INTO ads (title, price, location, description, image_url) 
			VALUES (:title, 
    			:price, 
    			:location, 
    			:description,
                :image_url)";


$stmt = $dbc->prepare($query);

foreach ($ads as $ad) {
	$stmt->bindValue(':title', $ad['title'], PDO::PARAM_STR);
	$stmt->bindValue(':price', $ad['price'], PDO::PARAM_STR);
	$stmt->bindValue(':location', $ad['location'], PDO::PARAM_STR);
	$stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $ad['image_url'], PDO::PARAM_STR);
	$stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";