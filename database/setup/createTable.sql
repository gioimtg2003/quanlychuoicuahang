CREATE TABLE product(
    id INT(15) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category_id INT(15) NOT NULL,
    branch_id INT(15) NOT NULL,
    image VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

CREATE TABLE category(
    id INT(15) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

CREATE TABLE branch(
    id INT(15) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE account(
    id INT(15) NOT NULL AUTO_INCREMENT,
    userName VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE cart(
    id INT(15) NOT NULL AUTO_INCREMENT,
    user_id INT(15) NOT NULL,
    product_id  INT(15) NOT NULL,
    quantity INT(3) NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE oder(
    id INT(15) NOT NULL AUTO_INCREMENT,
    user_id INT(15) NOT NULL,
    product_id  INT(15) NOT NULL,
    quantity INT(3) NOT NULL,
    status ENUM('pending','delivered','canceled') NOT NULL DEFAULT 'pending', 
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE payment(
    id INT(15) NOT NULL AUTO_INCREMENT,
    oder_id INT(15) NOT NULL,
    method ENUM('cash','card') NOT NULL DEFAULT 'cash',
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE oder_item(
    id INT(15) NOT NULL AUTO_INCREMENT,
    oder_id INT(15) NOT NULL,
    product_id  INT(15) NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE review(
    id INT(15) NOT NULL AUTO_INCREMENT,
    user_id INT(15) NOT NULL,
    product_id  INT(15) NOT NULL,
    rating INT(1) NOT NULL,
    comment TEXT NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;

CREATE TABLE canceled_oder(
    id INT(15) NOT NULL AUTO_INCREMENT,
    user_id INT(15) NOT NULL,
    oder_id  INT(15) NOT NULL,
    PRIMARY KEY (id)
)
 DEFAULT CHARSET=utf8;


alter table product add constraint fk_product_category foreign key (category_id) references category(id);
alter table product add constraint fk_product_branch foreign key (branch_id) references branch(id);
alter table cart add constraint fk_cart_user foreign key (user_id) references account(id);
alter table cart add constraint fk_cart_product foreign key (product_id) references product(id);
alter table oder add constraint fk_oder_user foreign key (user_id) references account(id);
alter table oder add constraint fk_oder_product foreign key (product_id) references product(id);
alter table payment add constraint fk_payment_oder foreign key (oder_id) references oder(id);
alter table oder_item add constraint fk_oder_item_oder foreign key (oder_id) references oder(id);
alter table oder_item add constraint fk_oder_item_product foreign key (product_id) references product(id);
alter table review add constraint fk_review_user foreign key (user_id) references account(id);
alter table review add constraint fk_review_product foreign key (product_id) references product(id);
alter table canceled_oder add constraint fk_canceled_oder_user foreign key (user_id) references account(id);
alter table canceled_oder add constraint fk_canceled_oder_oder foreign key (oder_id) references oder(id);

