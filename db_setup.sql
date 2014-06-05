-- Robert McDermot
-- rom66@pitt.edu

use rom66db;

drop table if exists users;
drop table if exists reviews;
drop table if exists messages;
drop table if exists comments;

create table users (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                     username varchar(20),
                     password text,
                     created datetime default null,
                     modified datetime default null);
create table reviews (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      user_id int unsigned,
                      title varchar(100),
                      body text,
                      rating int(2),
                      media varchar(20),
                      created datetime default null,
                      modified datetime default null,
                      constraint review_fk_user foreign key (user_id) references users(id));
create table messages (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       user_id int unsigned,
                       from_id int unsigned,
                       title varchar(100),
                       body text,
                       created datetime default null,
                       modified datetime default null,
                       constraint message_fk_user_to foreign key (user_id) references users(id),
                       constraint message_fk_user_from foreign key (from_id) references users(id));
create table comments (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       user_id int unsigned,
                       username varchar(20),
                       review_id int unsigned,
                       body text,
                       created datetime default null,
                       modified datetime default null,
                       constraint comment_fk_user foreign key (user_id) references users(id),
                       constraint comment_fk_user_username foreign key (username) references users(username),
                       constraint comment_fk_review foreign key (review_id) references reviews(id));