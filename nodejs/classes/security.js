const jwt = require('jsonwebtoken');

module.exports = class Security {

    static checkToken(req, res, next) {
        // if (!req.headers.authorization) {
        //     return res.status(401).send('Ooops, unauthorized request')
        // }
        // let token = req.headers.authorization.split(' ')[1]
        let token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEsImV4cGlyZSI6MTUzNzMyOTQ4MH0.wdRBdsoGR8pYQVZQzd4R2eNJHfcIDCKf8EVoVUbrIAw";

        if (token === 'null') {
            return res.status(401).send('Ooops, unauthorized request')
        }
        let payload = jwt.verify(token, 'sAMsamy7U_I')// return the decoded value only if it's valid
        if (!payload) {
            return res.status(401).send('Ooops, unauthorized request')
        }
        console.log(payload);
        req.userId = payload.userId
        next()
    }

}