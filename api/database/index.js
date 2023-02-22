const mysql = require('mysql2')

const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'cube2',
});

// const pool = mysql.createPool({
//     host: '137.135.245.31',
//     user: 'root',
//     password: 'Projetcube2',
//     database: 'cube2',
// });

module.exports = pool.promise()