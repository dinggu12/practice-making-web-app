const express = require('express');
const app = express();
const session = require('express-session');
const fs = require('fs');
let sql = require('./sql.js');


app.use(session({
    secret: 'secret code', //세션에 대한 키
    resave: false,
    saveUninitialized: false,
    cookie: {
        secure: false,
        maxAge: 1000 * 60 * 60 //쿠키 유효시간 1시간
    }
}));

app.use(express.json({
    limit: '50mb'
})); //request 요청할 때 바디로 json형태의 파라미터를 던질 수 있는데 그거를 웹서버에서 받으려면 이렇게 express.json을 선언해줘야함

const server = app.listen(3000, () => {
    console.log('server started. prot 3000.');
});



fs.watchFile(__dirname + '/sql.js', (curr, prev) => {
    console.log('sql 변경시 재시작 없이 반영되도록 함.');
    delete require.cache[require.resolve('./sql.js')];
    sql = require('./sql.js');
  });

const db = {
    database: "webproject",
    connectionLimit: 10,
    host: "localhost",
    port: 8000,
    user: "root",
    password: "password"
};

const dbPool = require('mysql').createPool(db);

app.post('/api/login', async (request, res) => {
    request.session['email'] = 'hello@naver.com';
    res.send('ok');
});

app.post('/api/logout', async (request, res) => {
    request.session.destroy();
    res.send('ok');
});


app.post('/apirole/:alias', async (request, res) => {
    if(!request.session.email){
        return res.status(401).send({error: 'you need to login'});
    }
    try {
        res.send(await req.db(request.params.alias));        
    } catch(err) {
        res.status(500).send({
            error: err
        });
    }
});

app.post('/api/:alias', async (request, res) => {
    try {
        res.send(await req.db(request.params.alias, request.body.param));  //프로덕트 디테일파일에서 param으로 던져서 파람으로 받는거임  
        console.log(request.body.param);  // [ '1' ]라고 뜸
    } catch(err) {
        res.status(500).send({
            error: err
        });
    }
});


const req = {
    async db(alias, param = [], where = '') {
      return new Promise((resolve, reject) => dbPool.query(sql[alias].query + where, param, (error, rows) => {
        if (error) {
          if (error.code != 'ER_DUP_ENTRY')
            console.log(error);
          resolve({
            error
          });
        } else resolve(rows);
      }));
    }
  }

