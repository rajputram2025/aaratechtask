1 -> clone project from git repo
2 -> Install composer inside project directory
3 -> change database configuration from .env file
4 -> import .sql file in your database
5 -> Run migration command and seed command to seed value for table
	php artisan migrate
	php artisan migrate:fresh --seed

6 -> Run project using php artisav serve
7 -> project screenshot that is given below.

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-57-07.png?raw=true "Title")

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-57-20.png?raw=true "Title")

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-57-26.png?raw=true "Title")

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-57-56.png?raw=true "Title")

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-58-01.png?raw=true "Title")

![Alt text](https://github.com/rajputram2025/aaratechtask/blob/main/Screenshot%20from%202021-11-29%2016-58-04.png?raw=true "Title")

Rest Api to get product list by user near by location that is given below:

api url -> localhost:8000/api/productlist/1

api type -> GET

1 is user_id for product list

Assign Role Rest api for a user using role like Admin, vendor .. etc

api url -> localhost:8000/api/assignRole

api type -> Post

request data -> role:Admin
		user_id:1
		
		


