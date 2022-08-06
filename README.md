# Ecommerce API Project

## Program Discription
A simple laravel ecommerce api project.

### How it works :
- Visitors can register/login either as merchants or end consumers.
- Merchants can set their store name.
- Merchants can decide if the VAT is included in the products price or should be calculated from the products price.
- Merchants can set shipping cost
- Merchants can set VAT percentage in case the VAT isn’t included in the product’s price.
- Merchants can add products with multilingual names and descriptions and prices.
- Merchants can end-consumers to add products to their carts.
- Calculate the cart’s total considering these subtotals:
    - a. Cart’s product prices.
    - b. Store VAT settings.
    - c. Store shipping cost.
- response with final detailed invoice

> **Hint:**  To avoid misunderstanding for me, The merchants can add products and (Plus point) merchant can adding with multible language for the same product .

## Program design and archtecture :
- the program foucses on back-end development
- developed with **laravel** framework
- Object Oriented Designed
- works with MySql as DBMS
- used some database design patterns like [**EAV**](https://pbedn.github.io/post/2020-05-25-entity-attribute-value/) for adding multilanguage details for product.

## API documentation :
- Please Find This [**Documentation**](https://documenter.getpostman.com/view/9030518/VUjMnkDh) for the project.

## How to run the program :
- clone program in your local repo
- you can use **XAMPP** control pannel to run program localy
- start your **Apache** server from XAMPP
- open the project folder in any **Editor** such as phpstorme,vscode
- run composer install
- create database with name ecommerce_db
- migrate the database tables
- open API plateform like **Postman**

