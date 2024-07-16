const fs = require('fs');
const path = require('path');

export default function handler(req, res) {
    const { method, body, query, headers } = req;

    const logFile = path.join('/tmp', `return-${new Date().toISOString().split('T')[0]}.log`);
    const logData = `
--------------- ${new Date().toISOString()} ---------------
METHOD: ${method}
BODY: ${JSON.stringify(body, null, 2)}
QUERY: ${JSON.stringify(query, null, 2)}
HEADERS: ${JSON.stringify(headers, null, 2)}
    `;

    fs.appendFile(logFile, logData, (err) => {
        if (err) {
            console.error("Error while logging data:", err);
            res.status(500).send(`Error logging data: ${err.message}`);
        } else {
            res.status(200).send('success');
        }
    });
}
