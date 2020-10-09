import firebase from 'firebase'
import 'firebase/firestore'
import { Collection } from '../lib/enum/Collection'
require('dotenv').config()

const $fireStore = firebase.initializeApp({
  databaseURL: process.env.FIREBASE_ADMIN_DATABASE_URL,
  projectId: process.env.FIREBASE_PROJECT_ID
}).firestore()

export default async () => {
  const _shopRoutes = await shopRoutes()

  return [
    ...staticRoutes,
    ..._shopRoutes
  ]
}

const staticRoutes: readonly string[] = [
  '/',
  '/insta',
  '/shops',
  '/keywords/area',
  '/keywords/detail',
  '/about/miyameshi'
]

const shopRoutes = async (): Promise<string[]> => {
  const _shops = await $fireStore
    .collection(Collection.SHOPS)
    .where('public', '==', true)
    .get()

  const _routes = [] as string[]
  _shops.forEach((_shop) => {
    _routes.push(_shop.id)
  })

  return _routes.map((_route: string) => `/shops/${_route}`)
}
