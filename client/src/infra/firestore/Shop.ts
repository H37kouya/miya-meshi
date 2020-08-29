import firebase from 'firebase'
import { Shop } from '@/lib/types/Shop'
import { Type } from '@/lib/enum'

const SHOP_COLLECTION_NAME = 'shops'

/**
 * Shop一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit 取得最大数
 * @param { Boolean } admin 管理者かどうか
 */
export const getShopList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', '==', true)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const shops = [] as Shop[]
  list.forEach((doc) => {
    shops.push(firestoreDocDataToShop(doc))
  })
  return shops
}

/**
 * Shop一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit 取得最大数
 * @param { Boolean } admin 管理者かどうか
 */
export const getShopListByInstaNumber = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', '==', true)
    .orderBy('instaNumber', 'desc')
    .where('instaNumber', '>', 0)

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const shops = [] as Shop[]
  list.forEach((doc) => {
    shops.push(firestoreDocDataToShop(doc))
  })
  return shops
}

/**
 * Shopの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getShopByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .doc(id)
    .get()
  return firestoreDocDataToShop(doc)
}

/**
 * FirebaseのデータをShop型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToShop = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: Type.SHOP,
    id: doc.id,
    ...docData
  } as Shop
}
