```js
// Создание тендора
fetch('index.php?tender', {
	method: 'POST',
	headers: {'content-type':'application/json'},
	body: JSON.stringify({number:'123-23',status:'Открыто',name:'Тестовый тендор'})
}).then(response => response.json()).then(data => console.log(data));

// Получить тендеры с указанной датой
fetch('index.php?listTender&date=2022-08-14 19:22:04', {
	headers: {'content-type': 'application/json'}
}).then(response => response.json()).then(data => console.log(data));

// Получить тендеры с указанным именем
fetch('index.php?listTender&name=Отводы закупка БФА', {
	headers: {'content-type': 'application/json'}
}).then(response => response.json()).then(data => console.log(data));

// Получить тендер по идетификатору
fetch('index.php?tender&id=152420172', {
	headers: {'content-type': 'application/json'}
}).then(response => response.json()).then(data => console.log(data));
```