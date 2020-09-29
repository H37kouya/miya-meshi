import firebase from 'firebase'
import * as admin from 'firebase-admin'
import { Shop } from '@/lib/types/Shop'
import { Collection, Type } from '@/lib/enum'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { formatShopAddress, formatShopPostal } from '@/src/utils/Shop'

const SHOP_COLLECTION_NAME = Collection.SHOPS

/**
 * Shopを追加する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { typeof firebase.firestore } $fireStoreObj
 * @param { Shop } shop
 */
export const createShop = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  shop: Shop
) => {
  shop.address = formatShopAddress(shop.address)
  shop.postal = formatShopPostal(shop.postal)
  shop.shopGeoPoint = new admin.firestore.GeoPoint(0,0)

  const addData = {
    ...removeUndefinedFromObject(shop),
    createdAt: $fireStoreObj.FieldValue.serverTimestamp(),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  } as firebase.firestore.DocumentData

  await $fireStore.collection(SHOP_COLLECTION_NAME).add(addData)
}

/**
 * Shopを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteShop = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(SHOP_COLLECTION_NAME).doc(id).delete()
}

/**
 * 店舗を編集する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { typeof firebase.firestore } $fireStoreObj
 * @param shop
 * @param { Shop['id] } shopID
 */
export const editShop = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  shop: Shop,
  shopID: Shop['id']
) => {
  const updateData = {
    ...removeUndefinedFromObject(shop),
    updatedAt: $fireStoreObj.FieldValue.serverTimestamp()
  }

  await $fireStore.collection(SHOP_COLLECTION_NAME).doc(shopID).update(updateData)
}

/**
 * Shop一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit 取得最大数
 * @param { Boolean } admin 管理者かどうか
 */
export const getShopList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12,
  admin: boolean = false
) => {
  const publicWhere: boolean[] = admin ? [true, false] : [true]

  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', 'in', publicWhere)
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
  limit: number = 12,
  admin: boolean = false
) => {
  const publicWhere: boolean[] = admin ? [true, false] : [true]

  const func = $fireStore
    .collection(SHOP_COLLECTION_NAME)
    .where('public', 'in', publicWhere)
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
