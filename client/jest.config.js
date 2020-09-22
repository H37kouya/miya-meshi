module.exports = {
  moduleNameMapper: {
    '^@/(.*)$': '<rootDir>/$1',
    '^~/(.*)$': '<rootDir>/$1',
    '^vue$': 'vue/dist/vue.common.js',
    '@nuxtjs/composition-api': '@nuxtjs/composition-api/lib/cjs/entrypoint.js'
  },
  moduleFileExtensions: [
    'ts',
    'js',
    'vue',
    'json'
  ],
  transform: {
    '^.+\\.ts$': 'ts-jest',
    '^.+\\.js$': 'babel-jest',
    '.*\\.(vue)$': 'vue-jest'
  },
  setupFilesAfterEnv: [
    '<rootDir>/test/setup.ts'
  ],
  collectCoverage: true,
  collectCoverageFrom: [
    '<rootDir>/middleware/**/*.vue',
    '<rootDir>/store/**/*.ts',
    '<rootDir>/src/**/*.ts'
  ]
}
