namespace php test.base

enum AppId
{
	ANDROID = 1,
	IOS = 2,
}

struct TestReqHead
{
	/** 会话标识，可选 */
	1: string skey,
	/** 客户端设备号 */
	2: string deviceId,
	/** 如果是H5微信端wechatId */
	3:	string wechatOpenId,
	/** 生产唯一hash */
	4:  string contentHash,
	/** 来源ID */
	5: i32 srcId,
	/** 二级来源 */
	6: string subSrc,
	/** wechatId */
	7:	string wechat2OpenId,
	/** wechat UnionID */
	8:	string wechatUnionId,
	/** user ip */
	9:	string userIp,
	/** 推广使用的设备标识 ios IDFA */
	10: string idfa,
}

struct Cookie
{
	1:	string name,
	2:	string value,
	3:	string domain,
	4:	string path,
	5:	i32 expires,
}

struct TestRespHead
{
	/** 服务器时间 */
	1: i64 time,
	/** 更新后的会话标识 */
	2: string skey,
	/** uid(h5日志) */
	3:	i32	uid,
	/** 生产唯一hash */
    4:  string contentHash,
    /** web View 需要的cookie */
    5:	list<Cookie> cookie,
}


exception TestException
{
	1: TestRespHead head,
	/** 错误码 */
	2: i32 retCode,
	/** 错误信息 */
	3: string retMsg,
}
