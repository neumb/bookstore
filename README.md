The bookstore service. The service provides API methods for fetching data in JSON format.

## Requirements
- PHP version 8+
- Laravel framework 10+
- Containerization: an ability to start the service via `docker compose up`

## Specs
- Methods for Creating and Updating an Author
  - Fields Validation:
    - name: mandatory string; length between 2 and 40 chars
    - information: non-mandatory string; length up to 1000 chars
    - birthday: non-mandatory date; format dd-mm-yyyy
- Method for Fetching a List of Authors with Pagination
  - Page limit: 15 items
  - The author object must contain total count of added books
  - The default sorting is by total count of added books
- Method for Fetching a Single Author
  - The author object must contain a list of added books
- Methods for Creating and Updating a Book
  - Fields Validation:
    - author\_id: integer with foreign key constraints check; mandatory
    - title: mandatory string; length between 2 and 100 chars
    - annotation: non-mandatory string; length up to 1000 chars
    - published\_at: mandatory date; format dd-mm-yyyy
- Method for Fetching a List of Books with Pagination
  - Page limit: 10 items
  - The book object must contain an information about the related author
- Method for Fetching a Single Book
  - The book object must contain an information about the related author


## Added Complexity:
- Req 1
  - [x] Implement functionality for the table of contents
  - [ ] Add counting of the number of characters in the text of all chapters of a book, update it after adding a new one chapter or updating it
- Req 2
  - [ ] Add information about the number of characters in the method for fetching the listing of books
  - [ ] Add the table of contents and text of chapters in the method for fetching a single book
- Req 3
  - [x] Write tests for the API methods

## Starting the Application
```sh
chmod o+w -R storage/framework
chmod o+w -R storage/logs
```

```sh
cp .env.example .env
```

```sh
docker compose up --build -d
```

```sh
docker compose exec app php artisan optimize:clear
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --force
docker compose exec app php artisan optimize
docker compose exec app php artisan db:seed --force
```

## Endpoints
### Paginate Authors
`[GET] api/authors`

### Show an Author
`[GET] api/authors/:id`

### Store a new Author
```
[POST] api/authors
{
  "name": "Fyodor Dostoevsky",
  "information": "Born in Moscow in 1821...",
  "birthday" => "11-11-1821"
}
```

### Update an Author
```
[PATCH] api/authors/:id
{
  "name": "Fyodor Dostoevsky",
  "information": "Born in Moscow in 1821...",
  "birthday" => "11-11-1821"
}
```

### Paginate Books
`[GET] api/books`

### Show a Book
`[GET] api/books/:id`

### Store a new Book
```
[POST] api/books
{
  "title": "1984",
  "author_id": 10,
  "published_at": "08-06-1949",
  "annotation": "A dystopian novel that explores the dangers..."
}
```

### Update a Book
```
[PATCH] api/books/:id
{
  "title": "1984",
  "author_id": 10,
  "published_at": "08-06-1949",
  "annotation": "A dystopian novel that explores the dangers..."
}
```

### List Chapters of a Book
`[GET] api/books/:id/chapters`

### Show a Chapter
`[GET] api/books/:id/chapters/:chapter_id`

### Store a new Chapter
```
[POST] api/books/:id/chapters
{
  "title": "Part One",
  "content": "Introduces the protagonist, Winston Smith, and the oppressive world of Oceania.",
  "index": 0
}
```

### Update a Chapter
```
[PATCH] api/books/:id/chapters/:chapter_id
{
  "title": "Part Two",
  "content": "Focuses on Winston's rebellion against the Party and his relationship with Julia.",
  "index": 1
}
```

### Delete a Chapter
```
[DELETE] api/books/:id/chapters/:chapter_id
```
