import firebase from 'firebase'
import { Menu } from '@/lib/types/Menu'
import { Collection, Type } from '@/lib/enum'

const MENU_COLLECTION_NAME = Collection.MENUS

/**
 * Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit
 */
export const getMenuList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(MENU_COLLECTION_NAME)
    .where('public', '==', true)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * ShopIDによって、Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } shopID
 * @param { Number } limit
 */
export const getMenuListByShopID = async (
  $fireStore: firebase.firestore.Firestore,
  shopID: string,
  limit: number = 12
) => {
  const func = $fireStore
    .collection(MENU_COLLECTION_NAME)
    .where('shopID', '==', shopID)
    .where('public', '==', true)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * Menuの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getMenuByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(MENU_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToMenu(doc)
}

/**
 * FirebaseのデータをMenu型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToMenu = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: Type.MENU,
    id: doc.id,
    ...docData
  } as Menu
}
