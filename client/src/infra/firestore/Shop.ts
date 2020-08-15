import firebase from 'firebase'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { ShopFormState } from '@/src/types/ShopFormState'

const SHOP_COLLECTION_NAME = 'shops'

/**
 * Shopを追加する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { typeof firebase.firestore } $fireStoreObj
 * @param { ShopFormState['shop']|Shop } shop
 */
export const createShop = async (
  $fireStore: firebase.firestore.Firestore,
  $fireStoreObj: typeof firebase.firestore,
  shop: ShopFormState['shop']|Shop
) => {
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
    type: SHOP_TYPE,
    id: doc.id,
    ...docData
  } as Shop
}
