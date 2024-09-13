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
  - Implement functionality for the table of contents
  - Add counting of the number of characters in the text of all chapters of a book, update it after adding a new one chapter or updating it
- Req 2
  - Add information about the number of characters in the method for fetching the listing of books
  - Add the table of contents and text of chapters in the method for fetching a single book
- Req 3
  - Write tests for the API methods
