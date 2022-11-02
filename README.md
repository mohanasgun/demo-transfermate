## About Project

This project is a web application developed using laravel framework with expressive, elegant syntax. 

List page will list the authors with their books.
There is a search option to filter data using author name.

Data will be sync every minute using scheduler. The data will be fetched from the files and all of that sub folder's files under the folder called xml-data which is located in storage path.

PostgreSql is used as database for storing data. There are two tables called authors and books. The table books is belongs to authors table.

By default I added few test data in xml files. Including one korean and japanese data.

I have designed like authors can have multiple books. Book belongs to one author.

I used JQuery for fast dynamic ajax call.

I added .env file also, since there is no security concerns there.
