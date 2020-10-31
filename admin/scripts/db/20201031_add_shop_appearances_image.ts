/**
 * shop.appearanceImageLink'no-image.png'で配列を埋めるコマンド
 */

import 'firebase/firestore'
import * as admin from 'firebase-admin'
const serviceAccount = require('../../serviceAccount.json')
require('dotenv').config()

const DEFAULT_IMAGE = '/no-image.png'

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
});
const firestore = admin.firestore()

const handler = async () => {
  const collection = firestore.collection('shops')
  const docQuery = await collection.get()

  docQuery.forEach((doc) => {
    const docID = doc.id
    const data = doc.data()

    let newAppearanceImageLink = []
    if (Array.isArray(data.appearanceImageLink) && data.appearanceImageLink.length < 9) {
      newAppearanceImageLink = data.appearanceImageLink
      for (let i = newAppearanceImageLink.length; i < 10; i++) {
        newAppearanceImageLink.push(DEFAULT_IMAGE)
      }

      console.log(`進行中：${docID}`)
      console.log(newAppearanceImageLink)
      collection.doc(docID).update({
        appearanceImageLink: newAppearanceImageLink
      })
    } else if (!data.appearanceImageLink) {
      newAppearanceImageLink = []
      for (let i = 0; i < 10; i++) {
        newAppearanceImageLink.push(DEFAULT_IMAGE)
      }

      console.log(`進行中：${docID}`)
      console.log(newAppearanceImageLink)
      collection.doc(docID).update({
        appearanceImageLink: newAppearanceImageLink
      })
    }
  })
}

(async () => {
  await handler()
}) ()
