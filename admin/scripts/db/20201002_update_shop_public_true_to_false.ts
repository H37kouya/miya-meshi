/**
 * shop.publicをすべてfalseにするコマンド
 */

import 'firebase/firestore'
import * as admin from 'firebase-admin'
const serviceAccount = require('../../serviceAccount.json')
require('dotenv').config()

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
});
const firestore = admin.firestore()

const handler = async () => {
  const collection = firestore.collection('shops')
  const docQuery = await collection.where('public', '==', true).get()

  docQuery.forEach((doc) => {
    const docID = doc.id

    console.log(`進行中：${doc.id}`)
    collection.doc(docID).update({
      public: false
    })
  })
}

(async () => {
  await handler()
}) ()
