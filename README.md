# Library System App
Simple system for the management of a library.

## Entities
- Book
    - id: int;
    - name: string;
    - authors: Author[];
- Author
    - id: int;
    - name: string
    - books: Book[]


## Use cases
- CRUD books;
- CRUD authors;
- Associate books to authors;