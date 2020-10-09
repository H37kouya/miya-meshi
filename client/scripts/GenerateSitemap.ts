import fs from 'fs'
import * as admin from 'firebase-admin'
import 'firebase/firestore'
import { Collection } from '../lib/enum/Collection'
const serviceAccount = require('../serviceAccount.json')
require('dotenv').config()

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
})
const $fireStore = admin.firestore()
const staticRoutes: readonly string[] = [
  '/',
  '/insta',
  '/shops',
  '/keywords/area',
  '/keywords/detail',
  '/about/miyameshi'
]

const shopRoutes = async (fireStore: FirebaseFirestore.Firestore): Promise<string[]> => {
  const _shops = await fireStore
    .collection(Collection.SHOPS)
    .where('public', '==', true)
    .get()

  const _routes = [] as string[]
  _shops.forEach((_shop) => {
    _routes.push(_shop.id)
  })

  return _routes.map((_route: string) => `/shops/${_route}`)
}

const handler = async () => {
  const _shopRoutes = await shopRoutes($fireStore)

  const routes = [
    ...staticRoutes,
    ..._shopRoutes
  ]

  fs.writeFileSync('../assets/json/sitemap.json', JSON.stringify(routes, null, '\t'))
}

handler()
