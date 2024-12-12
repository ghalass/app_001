const bURL = baseUrl;
const internalDelay = 0;

class Base {
  constructor() {
    this.controller = "";
    this.apiUri = bURL + this.controller + "/";
  }
  async get(url = "", params = []) {
    let URL = this.apiUri + url;
    let i = 0;
    for (var param in params) {
      if (params.hasOwnProperty(param)) {
        if (i == 0) {
          URL += "?" + param + "=" + params[param];
        } else {
          URL += "&" + param + "=" + params[param];
        }
      }
      i++;
    }
    // console.log(URL);
    let promis = new Promise(function (resolve, reject) {
      setTimeout(() => {
        $.ajax({
          method: "GET",
          url: URL,
          success: function (res, status, xhr) {
            // console.log(res);
            resolve(res);
          },
          error: function (xhr, status, err) {},
          complete: function () {},
        });
      }, internalDelay);
    });
    return await promis;
  }

  async post(url = "", data = []) {
    let URL = this.apiUri + url;
    // console.log(data);
    // console.log(URL);
    let promis = new Promise(function (resolve, reject) {
      setTimeout(() => {
        $.ajax({
          method: "POST",
          url: URL,
          data: data,
          success: function (res, status, xhr) {
            // console.log(res);
            resolve(res);
          },
          error: function (xhr, status, err) {},
          complete: function () {},
        });
      }, internalDelay);
    });
    return await promis;
  }

  async findAll() {
    const response = await this.get("findAll");
    return await JSON.parse(response);
  }

  /**
   *
   * @param {{ by: "id", id: 3 }} params
   * @returns promise
   */
  async findOne(params) {
    const response = await this.get("findOne", params);
    return await JSON.parse(response);
  }

  async findWhere(params) {
    const response = await this.get("findWhere", params);
    return await JSON.parse(response);
  }

  async createOne(params) {
    params.id = 0;
    const response = await this.post("createOne", params);
    // console.log(response);
    return await JSON.parse(response);
  }

  async updateOne(params, data) {
    data.id = 0;
    const response = await this.findOne(params).then((res) => {
      if (res) data.id = res.id;
      return this.post("updateOne", data);
    });
    // console.log(response);
    return await JSON.parse(response);
  }

  async deleteOne(params) {
    const response = await this.post("deleteOne", params);
    return await JSON.parse(response);
  }
}

class Auth extends Base {
  constructor() {
    super();
    this.controller = "auth";
    this.apiUri = bURL + this.controller + "/";
  }
}

class User extends Base {
  constructor() {
    super();
    this.controller = "users";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Site extends Base {
  constructor() {
    super();
    this.controller = "sites";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Typeparc extends Base {
  constructor() {
    super();
    this.controller = "typeparcs";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Parc extends Base {
  constructor() {
    super();
    this.controller = "parcs";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Engin extends Base {
  constructor() {
    super();
    this.controller = "engins";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Typelubrifiant extends Base {
  constructor() {
    super();
    this.controller = "typelubrifiants";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Lubrifiant extends Base {
  constructor() {
    super();
    this.controller = "lubrifiants";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Objectiflubrifiant extends Base {
  constructor() {
    super();
    this.controller = "objectiflubrifiants";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Saisielubrifiant extends Base {
  constructor() {
    super();
    this.controller = "saisielubrifiants";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Specifiques extends Base {
  constructor() {
    super();
    this.controller = "specifiques";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Typeorgane extends Base {
  constructor() {
    super();
    this.controller = "typeorganes";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Organe extends Base {
  constructor() {
    super();
    this.controller = "organes";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Mouvementorgane extends Base {
  constructor() {
    super();
    this.controller = "mouvementorganes";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Fichevieorgane extends Base {
  constructor() {
    super();
    this.controller = "fichevieorganes";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Saisierje extends Base {
  constructor() {
    super();
    this.controller = "performances";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Typepanne extends Base {
  constructor() {
    super();
    this.controller = "typepannes";
    this.apiUri = bURL + this.controller + "/";
  }
}

class Panne extends Base {
  constructor() {
    super();
    this.controller = "pannes";
    this.apiUri = bURL + this.controller + "/";
  }
}
