# php-like-system
 
Like and Dislike System

## Prerequisites
#### MySql Server
Table  **posts**
- id `PRIMARY KEY`
- text `TEXT`

Table  **rating_info**
- post_id `UNIQUE`
- user_id `UNIQUE`
- rating_action `VARCHAR`